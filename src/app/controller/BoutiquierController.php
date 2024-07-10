<?php

namespace Boutique\App\Controller;

use Boutique\App\App;
use Boutique\Core\Controller;
use Boutique\Core\Session;
use Boutique\Core\Validator;

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
class BoutiquierController extends Controller
{
    private $clientModel;
    private $detteModel;
    private $articleModel;
    private $detailDetteModel;
    private $paiementModel;

    public function __construct()
    {
        parent::__construct();

        $this->clientModel = App::getInstance()->getModel('Client');
        $this->detteModel = App::getInstance()->getModel('Dette');
        $this->articleModel = App::getInstance()->getModel('Article');
        $this->detailDetteModel = App::getInstance()->getModel('DetailDette');
        $this->paiementModel = App::getInstance()->getModel('Paiement');
    }
    public function index()
    {
        $data = [];
        $data['montant_verse'] = 0;
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');
            // dd($this->toJSON($data['clientFound']));
            // dd($data['clientFound']->toArray());
            if ($this->clientModel->getDetteClient($data['clientFound']->id)) {
                $data['total_dette'] = $this->clientModel->getDetteClient($data['clientFound']->id)->total_dette;
                if ($this->clientModel->getMontantVerserClient($data['clientFound']->id))
                    $data['montant_verse'] = $this->clientModel->getMontantVerserClient($data['clientFound']->id)->montant_verse;
                $data['montant_restant'] = (int)$data['total_dette'] - (int)$data['montant_verse'];
            }
        }

        if ($this->session::issetE('errorForm')) {
            $data['errorForm'] = $this->session::get('errorForm');
        }

        if ($this->session::issetE('success')) {
            $data['success'] = $this->session::get('success');
        }

        if ($this->session::issetE('success')) {
            $data['error'] = $this->session::get('error');
        }

        if ($this->session::issetE('validValues')) {
            $data['validValues'] = $this->session::get('validValues');
            // dd($data['validValues']);
        }

        $this->renderView('index_dette', $data);
    }

    public function addDetteIndex()
    {
        $data = [];
        $data['montant_total'] = 0;
        // dd($this->session::get('current_article'));
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');

            if ($this->session::issetE('current_article')) {
                // dd($this->session::restoreObjectFromSession('Article', 'current_article'));
                $data['current_article'] = $this->session::restoreObjectFromSession('Article', 'current_article');
            }

            if ($this->session::issetE('panier')) {
                $data['panier'] = $this->session::restoreObjectsFromSessionArray('Article', 'panier');
                foreach ($data['panier'] as $dp) {
                    $data['montant_total'] += $dp->prix * $dp->qte;
                }
            }

            if ($this->session::issetE('errorSearchRef')) {
                $data['errorSearchRef'] = $this->session::get('errorSearchRef');
            }
            if ($this->session::issetE('errorAdd')) {
                $data['errorAdd'] = $this->session::get('errorAdd');
                // dd($data['errorAdd']);
            }

            $this->renderView('ajout_dette', $data);
        } else {
            $this->redirect('/dettes');
        }
    }
    public function listeDetteIndex()
    {
        $data = [];
        $data['listesDettesDuClient'] = [];
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');
            $data['listesDettesDuClient'] = $this->detteModel->getOneClientDettes($data['clientFound']->id, 'NON SOLDER');
            // dd($data['listesDettesDuClient']);
            $data['etat'] = ['NON SOLDER', 'SOLDER'];
            $this->renderView('liste_dette', $data);
        } else {
            $this->redirect('/dettes');
        }
    }
    public function listeDetteFiltre()
    {
        $data = [];
        $data['listesDettesDuClient'] = [];
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');
            $data['listesDettesDuClient'] = $this->detteModel->getOneClientDettes($data['clientFound']->id, $_POST['etat']);
            $data['selectedEtat'] =  $_POST['etat'];
            $data['etat'] = ['NON SOLDER', 'SOLDER'];
            $this->renderView('liste_dette', $data);
        } else {
            $this->redirect('/dettes');
        }
    }
    public function addClient()
    {
        $_POST['password'] = $this->hasherPassword("passer@1");
        $count_error = 0;
        $fileName = $this->uploadFile('photo', $_ENV['UPLOAD_DIR'] . '/mes_images');
        if (!$fileName) {
            $this->session::setArray('errorForm', 'photo', 'Erreur lors de l\'upload de la photo');
        }
        $_POST['photo'] = $fileName;

        $errorCount = Validator::validate($_POST, [
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email', 'unique'],
            'telephone' => ['required', 'phone', 'unique'],
            'password' => ['required'],
            'photo' => ['required'],
        ]);

        if ($errorCount > 0) {
            $errors = Validator::getErrors();
            $this->session::set('errorForm', $errors);

            $postkeys = array_keys($_POST);
            $errorkeys = array_keys($errors);

            $errorkeys = array_diff($postkeys, $errorkeys);
            $errorkeys = array_values($errorkeys);

            $validValues = [];
            foreach ($errorkeys as $key) {
                $validValues[$key] = $_POST[$key];
            }
            // dd($validValues);
            $this->session::set('validValues', $validValues);
        } else {
            $result_add = $this->clientModel->save($_POST);

            if ($result_add) {
                $this->session::set('success', 'Client ajouté avec succès');
            } else {
                $this->session::set('error', 'Erreur lors de l\'ajout du client');
            }
        }
        $this->redirect('/dettes');
    }

    public function searchClient()
    {
        $client = $this->clientModel->find(["telephone" => $_POST['telephone_search']]);
        if ($client != null) {
            $this->session::saveObjectToSession($client, 'found_client');
        } else {
            $this->session::unset('found_client');
        }

        $this->redirect('/dettes');
    }

    public function addDetteSearchRef()
    {
        if (isset($_POST['reference']) && !empty($_POST['reference'])) {
            $article = $this->articleModel->find(['reference' => $_POST['reference']]);
            if ($article) {
                $this->session::saveObjectToSession($article, 'current_article');
            } else {
                $this->session::set('errorSearchRef', 'Aucun article correspondant à cette référence');
                // $this->session::unset('current_article');
                // $this->session::unset('panier');
                $this->session::unset('current_article');
            }
        }
        $this->redirect('/dettes/add');
    }

    public function addDetteArticle()
    {
        // dd($this->session::issetE('found_client'));
        // dd($this->session::issetE('current_article'));
        if ($this->session::issetE('found_client')) {
            if ($this->session::issetE('current_article')) {
                $client = $this->session::restoreObjectFromSession('Client', 'found_client');
                $article = $this->session::restoreObjectFromSession('Article', 'current_article');


                $errorCount = Validator::validate($_POST, [
                    'quantite' => ['required', 'number']
                ]);
                // dd($errorCount);
                if ($errorCount > 0) {
                    $errors = Validator::getErrors();
                    $this->session::set('errorAdd', $errors);
                } else {
                    if ($article->qte >= (int) $_POST['quantite']) {

                        $article->qte = (int) $_POST['quantite'];

                        $this->session::saveObjectToSessionArray($article, 'panier');
                    } else {
                        $errors['quantite'] = 'Quantité insufisante';
                        $this->session::set('errorAdd', $errors);
                    }
                }

                $this->redirect('/dettes/add');
            } else {
                $this->redirect('/dettes/add');
            }
        } else {
            $this->redirect('/dettes');
        }
    }

    public function addDette()
    {
        $client = $this->session::restoreObjectFromSession('Client', 'found_client');
        $articles = $this->session::restoreObjectsFromSessionArray('Article', 'panier');
        $resultsaveDette = $this->detteModel->save([
            'client_id' => $client->id,
            'utilisateur_id' => 1,
            'date' => date('Y-m-d'),
            'etat' => 'NON SOLDER',
        ]);

        foreach ($articles as $article) {
            $this->detailDetteModel->save([
                'article_id' => $article->id,
                'dette_id' => $resultsaveDette,
                'prix' => $article->prix,
                'qte' => $article->qte,
            ]);
        }
        $this->session::unset('panier');
        $this->session::unset('current_article');

        $this->redirect('/dettes/liste');
    }

    public function paiementForm()
    {
        $data = [];
        $data['listesDettesDuClient'] = [];
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');
            $listesDettesDuClient = $this->detteModel->getOneClientDettes($data['clientFound']->id, 'NON SOLDER');
            // dd($listesDettesDuClient);
            if (isset($_POST['dette_id']) && !empty($_POST['dette_id'])) {
                $laDette = array_filter($listesDettesDuClient, function ($dette) {
                    return $dette->id == (int)$_POST['dette_id'];
                });
                $laDette = array_values($laDette);
                // dd($laDette);
                $data['laDette'] =  $laDette[0];
            }
            $this->renderView('ajout_paiement', $data);
        }
    }

    public function paiementAdd()
    {
        if (isset($_POST['dette_id']) && isset($_POST['montant'])) {
            if (!empty($_POST['dette_id']) && !empty($_POST['montant'])) {
                $result = $this->paiementModel->save([
                    'dette_id' => (int)$_POST['dette_id'],
                    'montant' => (float)$_POST['montant'],
                    'date' => date('Y-m-d')
                ]);

                if ($result) {
                    $this->redirect('/dettes/liste');
                }
            }
        }
    }

    public function paiementListe()
    {
        $data = [];
        $data['listesDettesDuClient'] = [];
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');
            $listesDettesDuClient = $this->detteModel->getOneClientDettes($data['clientFound']->id, 'NON SOLDER');
            if (isset($_POST['dette_id']) && !empty($_POST['dette_id'])) {
                $laDette = array_filter($listesDettesDuClient, function ($dette) {
                    return $dette->id == (int)$_POST['dette_id'];
                });
                $laDette = array_values($laDette);

                $data['laDette'] =  $laDette[0];

                $data['listePaiement'] = $this->paiementModel->getDettePaiement((int) $_POST['dette_id']);
                // dd($date['listePaiement']);
            }
            $this->renderView('liste_paiement', $data);
        }
    }

    public function hasherPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function uploadFile($fileKey, $targetDir)
    {
        if (!isset($_FILES[$fileKey])) {
            return false;
        }

        $file = $_FILES[$fileKey];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        $fileName = uniqid() . '.' . $fileExtension;

        $targetFilePath = rtrim($targetDir, '/') . '/' . $fileName;

        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                return false;
            }
        }

        if (!move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return false;
        }

        return $fileName;
    }

    // public function verifierPassword($passwordIn){

    // }
}

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

        $this->renderView('/boutiquier/index_dette', $data);
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

            $this->renderView('/boutiquier/ajout_dette', $data);
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
            // dd($this->clientModel->getEntity());
            $this->clientModel->getEntity()->id = (int) $data['clientFound']->id;
            // dd($this->clientModel->getDettesNonSolder());
            $data['listesDettesDuClient'] = $this->clientModel->getDettesNonSolder();
            // dd($data['listesDettesDuClient']);
            $data['etat'] = ['NON SOLDER', 'SOLDER'];
            $this->renderView('/boutiquier/liste_dette', $data);
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
            $this->clientModel->getEntity()->id = (int) $data['clientFound']->id;
            // dd($_POST['etat']);
            if (isset($_POST['etat']) &&  $_POST['etat'] == "NON SOLDER") {
                $data['listesDettesDuClient'] = $this->clientModel->getDettesNonSolder();
            } else {
                $data['listesDettesDuClient'] = $this->clientModel->getDettesSolder();
            }
            $data['selectedEtat'] =  $_POST['etat'];
            $data['etat'] = ['NON SOLDER', 'SOLDER'];
            $this->renderView('/boutiquier/liste_dette', $data);
        } else {
            $this->redirect('/dettes');
        }
    }
    public function addClient()
    {
        $_POST['password'] = $this->hasherPassword("passer@1");
        $count_error = 0;
        $fileName = $this->file->load('photo');
        if (!$fileName) {
            $this->session::setArray('errorForm', 'photo', 'Erreur lors de l\'upload de la photo');
        }
        $_POST['photo'] = $fileName;

        $errors = $this->validator->validate($_POST, [
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email', 'uniqueclient'],
            'telephone' => ['required', 'phone', 'uniqueclient'],
            'password' => ['required'],
            'photo' => ['required'],
        ]);

        if (count($errors) > 0) {
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
        if ($this->session::issetE('found_client')) {
            if ($this->session::issetE('current_article')) {
                $client = $this->session::restoreObjectFromSession('Client', 'found_client');
                $article = $this->session::restoreObjectFromSession('Article', 'current_article');


                $errors = $this->validator->validate($_POST, [
                    'quantite' => ['required', 'number']
                ]);
                if (count($errors) > 0) {
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
            if (isset($_POST['dette_id']) && !empty($_POST['dette_id'])) {
                $data['laDette'] = $this->detteModel->find(['id' => $_POST['dette_id']]);

                $this->clientModel->getEntity()->id = $data['clientFound']->id;
                $data['laDette']->total_dette = $this->clientModel->getMontantTotalDette($data['laDette']->id);
                $data['laDette']->montant_verse = $this->clientModel->getMontantVerserDette($data['laDette']->id);

                if ($this->session::issetE('errorPaiement')) {
                    $data['errorPaiement'] = $this->session::get('errorPaiement');
                    // dd($data['validValues']);
                }
            }
            $this->renderView('/boutiquier/ajout_paiement', $data);
        }
    }

    public function paiementFormShow($id)
    {
        $data = [];
        $data['listesDettesDuClient'] = [];
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');
            if (isset($id) && !empty($id)) {
                $data['laDette'] = $this->detteModel->find(['id' => $id]);

                $this->clientModel->getEntity()->id = $data['clientFound']->id;
                $data['laDette']->total_dette = $this->clientModel->getMontantTotalDette($data['laDette']->id);
                $data['laDette']->montant_verse = $this->clientModel->getMontantVerserDette($data['laDette']->id);

                if ($this->session::issetE('errorPaiement')) {
                    $data['errorPaiement'] = $this->session::get('errorPaiement');
                    // dd($data['validValues']);
                }
            }
            $this->renderView('/boutiquier/ajout_paiement', $data);
        }
    }


    public function paiementAdd()
    {
        // dd($_POST);
        if (isset($_POST['dette_id']) && isset($_POST['montant'])) {
            $dette_id = (int) trim($_POST['dette_id']);
            if (!empty($_POST['dette_id']) && !empty($_POST['montant'])) {
                $errors = $this->validator->validate($_POST, [
                    'dette_id' =>  ["required"],
                    'montant' => ["required", "number"]
                ]);
                if (count($errors)) {

                    $this->session::set('errorPaiement', $errors);
                    $this->redirect("/dettes/paiement/{$dette_id}");
                    exit();
                }
                $dette = $this->detteModel->find(['id' => $dette_id]);
                $this->clientModel->getEntity()->id = $dette->client_id;
                $montant_total_dette = $this->clientModel->getMontantTotalDette($dette->id);
                $montant_verser_dette = $this->clientModel->getMontantVerserDette($dette->id);
                $montant_restant_dette = $montant_total_dette - $montant_verser_dette;

                if ((int)$_POST['montant'] > $montant_restant_dette) {
                    $this->session::set('errorPaiement', ['montant' => 'Le montant ne doit pas être supérieur au montant restant']);
                    $this->redirect("/dettes/paiement/{$dette_id}");
                    exit();
                }
                $result = $this->paiementModel->save([
                    'dette_id' => (int)$dette_id,
                    'montant' => (float)$_POST['montant'],
                    'date' => date('Y-m-d')
                ]);

                if (($montant_restant_dette - (float)$_POST['montant']) == 0) {
                    $this->detteModel->setTable();
                    $result = $this->detteModel::update([
                        "etat" => "SOLDER",
                        "id" => (int)$dette_id
                    ]);
                }

                if ($result) {
                    $this->redirect('/dettes/liste');
                }
            } else {
                $this->session::set('errorPaiement', ['montant' => 'Le champs montant est vide']);
                $this->redirect("/dettes/paiement/{$dette_id}");
                exit();
            }
        }
    }

    public function paiementListe()
    {
        $data = [];
        $data['listesDettesDuClient'] = [];
        if ($this->session::issetE('found_client')) {
            $data['clientFound'] = $this->session::restoreObjectFromSession('Client', 'found_client');
            if (isset($_POST['dette_id']) && !empty($_POST['dette_id'])) {
                $data['laDette'] = $this->detteModel->find(['id' => $_POST['dette_id']]);

                $this->clientModel->getEntity()->id = $data['clientFound']->id;
                $data['laDette']->total_dette = $this->clientModel->getMontantTotalDette($data['laDette']->id);
                $data['laDette']->montant_verse = $this->clientModel->getMontantVerserDette($data['laDette']->id);
                $this->detteModel->getEntity()->id = $data['laDette']->id;
                $data['listePaiement'] = $this->detteModel->getPaiements($data['laDette']->id);
                // $data['listePaiement'] = $this->paiementModel->getDettePaiement((int) $_POST['dette_id']);
            }
            $this->renderView('/boutiquier/liste_paiement', $data);
        }
    }

    public function hasherPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

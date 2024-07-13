<?php

namespace Boutique\App\Model;

use Boutique\Core\Model\Model;

class ClientModel extends Model
{

    public function getDetteClient($id)
    {
        return $this->query("SELECT COALESCE(SUM(dd.prix*dd.qte), 0) as total_dette
        FROM `clients` cli JOIN dettes d ON d.client_id = cli.id
        JOIN detaildettes dd ON dd.dette_id = d.id WHERE cli.id = :id 
        GROUP BY cli.id;", $this->getEntityName(), ['id' => $id], true);
    }

    public function getMontantVerserClient($id)
    {
        return $this->query("SELECT COALESCE(SUM(p.montant),0) as montant_verse 
        FROM `clients` cli JOIN dettes d ON d.client_id = cli.id 
        JOIN paiements p ON p.dette_id = d.id WHERE cli.id = :id 
        GROUP BY d.id;", $this->getEntityName(), ['id' => $id], true);
    }

    public function getDetteNonSolder()
    {
    }

    public function getMontantVerserDette($dette_id)
    {
        $montant_verse = 0;
        foreach ($this->dettes as $dette) {

            if ($dette->getEntity()->id == $dette_id) {
                foreach ($dette->paiements as $paiement) {
                    $montant_verse += $paiement->getEntity()->montant;
                }
                return $montant_verse;
            }
        }
        return $montant_verse;
    }

    public function getMontantTotalDette($dette_id)
    {
        $montant_total = 0;
        // dd(0);
        foreach ($this->dettes as $dette) {
            if ($dette->getEntity()->id == $dette_id) {
                foreach ($dette->articles as $article) {
                    $montant_total += $article->getEntity()->prix * $article->getEntity()->qte;
                }

                // dd($montant_total);
                return $montant_total;
            }
        }
        return $montant_total;
    }

    public function getAllDettes()
    {
        $result = [];
        foreach ($this->dettes as $dette) {
            $dette->getEntity()->total_dette = $this->getMontantTotalDette($dette->getEntity()->id);
            $dette->getEntity()->montant_verse = $this->getMontantVerserDette($dette->getEntity()->id);
            $result[] = $dette->getEntity();
        }
        // dd($result);
        return $result;
    }



    public function getDettesNonSolder()
    {
        $result = array_filter($this->getAllDettes, function ($dette) {
            if ($dette->etat == 'NON SOLDER') {
                return true;
            }
        });

        return array_values($result);
    }

    public function getDettesSolder()
    {
        $result = array_filter($this->getAllDettes, function ($dette) {
            if ($dette->etat == 'SOLDER') {
                // dd($dette);
                return true;
            }
        });

        return array_values($result);
    }

    public function dettes()
    {
        return $this->hasMany('DetteEntity');
    }
}

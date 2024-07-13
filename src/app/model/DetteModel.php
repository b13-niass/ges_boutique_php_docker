<?php

namespace Boutique\App\Model;

use Boutique\Core\Model\Model;

class DetteModel extends Model
{

    public function getOneClientDettes($id, $etat)
    {
        return $this->query("SELECT lastone.id,lastone.date,lastone.etat, 
        lastone.total_dette, COALESCE(SUM(p.montant), 0) as montant_verse FROM 
        (SELECT dnsolder.id,dnsolder.date,dnsolder.etat, 
        SUM(dd.prix*dd.qte) as total_dette FROM (SELECT d.id,d.date,d.etat 
        FROM dettes d JOIN clients cl ON cl.id = d.client_id WHERE cl.id = :id  
        AND d.etat = :etat) as dnsolder
        JOIN detaildettes dd ON dd.dette_id = dnsolder.id GROUP BY dnsolder.id) as lastone 
        LEFT JOIN paiements p ON p.dette_id = lastone.id GROUP BY lastone.id;", $this->getEntityName(), ['id' => $id, 'etat' => $etat]);
    }

    public function getAllClientDettes($etat)
    {
        return $this->query("SELECT lastone.id,lastone.date,lastone.etat, 
        lastone.total_dette, COALESCE(SUM(p.montant), 0) as montant_verse FROM 
        (SELECT dnsolder.id,dnsolder.date,dnsolder.etat, 
        SUM(dd.prix*dd.qte) as total_dette FROM (SELECT d.id,d.date,d.etat 
        FROM dettes d JOIN clients cl ON cl.id = d.client_id WHERE d.etat = :etat) as dnsolder
        JOIN detaildettes dd ON dd.dette_id = dnsolder.id GROUP BY dnsolder.id) as lastone 
        LEFT JOIN paiements p ON p.dette_id = lastone.id GROUP BY lastone.id;", $this->getEntityName(), ['etat' => $etat]);
    }

    public function client()
    {
        return $this->belongsTo('ClientEntity');
    }

    public function articles()
    {
        return $this->belongsToMany('DetailDetteEntity', 'ArticleEntity');
    }

    public function paiements()
    {
        return $this->hasMany('PaiementEntity');
    }

    public function utilisateur()
    {
        return $this->belongsTo('UtilisateurEntity');
    }

    public function montantOneDette($dette_id)
    {
        $montant_total = 0;
        foreach ($this->articles as $detarticle) {
            if ($detarticle->getEntity()->dette_id == $dette_id) {
                $montant_total += $detarticle->entity->prix * $detarticle->entity->qte;
            }
        }
        return $montant_total;
    }
    public function getAllDettes()
    {
        $result = array_map(function ($dette) {
            $dette->total_dette = $this->montantOneDette($dette->id);
            return $dette;
        }, $this->all());

        return array_values($result);
    }

    public function getDetteNonSolder()
    {
        $result = array_filter($this->getAllDettes, function ($dette) {
            if ($dette->etat == 'NON SOLDER') {
                return true;
            }
        });

        return array_values($result);
    }

    public function getDetteSolder()
    {
        $result = array_filter($this->getAllDettes, function ($dette) {
            if ($dette->etat == 'SOLDER') {
                return true;
            }
        });

        return array_values($result);
    }

    public function getPaiements($dette_id)
    {
        $paiements = [];
        foreach ($this->paiements as $paiement) {
            if ($paiement->getEntity()->dette_id == $dette_id) {
                $paiements[] = $paiement->getEntity();
            }
        }
        return $paiements;
    }
}

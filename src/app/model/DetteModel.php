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
}

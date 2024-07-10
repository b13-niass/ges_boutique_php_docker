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
}

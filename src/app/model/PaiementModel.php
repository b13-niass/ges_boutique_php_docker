<?php

namespace Boutique\App\Model;

use Boutique\Core\Model\Model;

class PaiementModel extends Model
{

    public function getDettePaiement($dette)
    {
        return $this->query("SELECT * FROM paiements p WHERE p.dette_id = :dette_id;", $this->getEntityName(), ['dette_id' => $dette]);
    }


    public function dette(){
        return $this->belongsTo('DetteEntity');
    }

}

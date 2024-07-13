<?php

namespace Boutique\App\Model;

use Boutique\Core\Model\Model;

class DetailDetteModel extends Model
{

    public function dette()
    {
        return $this->belongsTo('DetteEntity');
    }

    public function article()
    {
        return $this->belongsTo('ArticleEntity');
    }
}

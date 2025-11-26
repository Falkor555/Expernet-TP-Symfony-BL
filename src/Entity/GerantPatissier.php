<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use App\Entity\Utilisateur;

class GerantPatissier extends Utilisateur
{
    #[Column(type: 'string', length: 255)]
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

}

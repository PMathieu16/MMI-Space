<?php


namespace App\Data;


use App\Entity\Bac;
use App\Entity\FieldActivity;
use App\Entity\FieldStudy;
use Doctrine\ORM\Mapping as ORM;

class SearchUser
{

    /**
     * @var int
     */
    public $page=1;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    public $q="";

    /**
     * @ORM\Column(nullable=true)
     * @var Bac
     */
    public $bac;

    public $promo;

    /**
     * @ORM\Column(nullable=true)
     * @var FieldStudy
     */
    public $fieldStudy;

    /**
     * @ORM\Column(nullable=true)
     * @var FieldActivity
     */
    public $fieldActivity;


}
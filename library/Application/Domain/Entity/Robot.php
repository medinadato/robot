<?php

namespace Application\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * 
 * @ORM\Entity(repositoryClass="Application\Domain\Repository\Robot")
 * @ORM\Table(name="robot")
 * @author Renato Medina [medinadato@hotmail.com]
 */
class Robot
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @var integer
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=1)
     * @var integer
     */
    protected $x;

    /**
     * @ORM\Column(type="integer", length=1)
     * @var integer
     */
    protected $y;
    
    /**
     * @ORM\Column(type="string", length=10)
     * @var integer
     */
    protected $face;

    public function __construct()
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setX($x)
    {
        $this->x = $x;
        return $this;
    }
    
    public function getY()
    {
        return $this->y;
    }

    public function setY($y)
    {
        $this->y = $y;
        return $this;
    }
    
    public function getFace()
    {
        return $this->face;
    }

    public function setFace($face)
    {
        $this->face = $face;
        return $this;
    }

}

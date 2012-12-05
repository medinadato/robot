<?php

namespace Application\Domain\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of Robot
 *
 * @author Renato Medina <medinadato@gmail.com>
 */
class Robot extends EntityRepository
{

    private $directions = array(
        'NORTH',
        'SOUTH',
        'EAST',
        'WEST',
    );

    /**
     * Gets the Robot Object
     * 
     * @return object Robot
     */
    public function get()
    {
        return $this->find(1);
    }

    /**
     * 
     * @param int $x
     * @param int $y
     * @param string $face
     * @return boolean
     */
    public function move($x = 0, $y = 0, $face = false)
    {
        $robotEntity = $this->get();

        $robotEntity->setX($x)
                ->setY($y);

        if ($face) {

            if (!in_array($face, $this->directions))
                throw new \Exception('The parameter ' . $face . ' is not a invalid one.');

            $robotEntity->setFace($face);
        }

        $this->getEntityManager()->persist($robotEntity);
        $this->getEntityManager()->flush();

        return true;
    }

    /**
     * Define which direction to take
     * 
     * @param string $direction
     * @return boolean
     * @throws \Exception
     */
    public function turn($direction)
    {
        $robotEntity = $this->get();

        if (!in_array($direction, $this->directions))
            throw new \Exception('The parameter ' . $direction . ' is not a invalid one.');

        $robotEntity->setFace($direction);
        
        $this->getEntityManager()->persist($robotEntity);
        $this->getEntityManager()->flush();

        return true;
    }

    /**
     * 
     * @param int $x
     * @return int
     */
    private function checkX($x)
    {
        $x = ($x < $this->minX) ? $this->minX : $x;
        $x = ($x > $this->maxX) ? $this->maxX : $x;

        return $x;
    }

    /**
     * 
     * @param int $y
     * @return int
     */
    private function checkY($y)
    {
        $y = ($y < $this->minY) ? $this->minY : $y;
        $y = ($y > $this->maxY) ? $this->maxY : $y;

        return $y;
    }

}

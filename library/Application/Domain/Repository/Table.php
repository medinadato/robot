<?php

namespace Application\Domain\Repository;

/**
 * Description of Table
 *
 * @author Renato Medina <medinadato@gmail.com>
 */
class Table
{

    /**
     *
     * @var int the minimum position with X 
     */
    private $minX = 0;

    /**
     * @var int the maximum position with X 
     */
    private $maxX = 4;

    /**
     * @var int the minimum position with Y 
     */
    private $minY = 0;

    /**
     * @var int the maximum position with Y
     */
    private $maxY = 4;

    /**
     *
     * @var array List of commands available 
     */
    private $actions = array(
        'PLACE',
        'MOVE',
        'LEFT',
        'RIGHT',
        'REPORT',
    );

    /**
     *
     * @var object $robot Entity Robot
     */
    private $robot;
    
    private $robotRepository;

    /**
     *
     * @var object Entity Manager 
     */
    private $em;

    public function __construct()
    {
        $this->em = \Zend_Registry::get('doctrine')->getEntityManager();

        $this->robotRepository = $this->em->getRepository('app:Robot');
        $this->robot = $this->robotRepository->get();
    }

    /**
     * Factory the requested method 
     *
     * @param  array $options
     * @return Grid
     */
    public function setOption($action, $params)
    {
        $method = 'set' . ucfirst(strtolower($action));

        if (!method_exists($this, $method))
            throw new \Exception("Unknown method {$method}");

        return $this->$method($params);
    }

    /**
     * 
     * @param array $options
     */
    private function setPlace($options = array())
    {
        $x = $options[0];
        $y = $options[1];
        $face = $options[2];

        $x = $this->checkX($x);
        $y = $this->checkY($y);

        $this->robotRepository->move($x, $y, $face);
    }

    /**
     * 
     * @param array $options
     * @return boolean
     */
    private function setMove($options = array())
    {
        $x = $this->robot->getX();
        $y = $this->robot->getY();
        $face = $this->robot->getFace();

        switch ($face) {
            case 'NORTH':
                $y++;
                break;
            case 'SOUTH':
                $y--;
                break;
            case 'EAST':
                $x++;
                break;
            case 'WEST':
                $x--;
                break;
        }

        $x = $this->checkX($x);
        $y = $this->checkY($y);
        
        $this->robotRepository->move($x, $y);
        
        return true;
    }

    /**
     * 
     * @param array $options
     */
    private function setLeft($options = array())
    {
        $face = $this->robot->getFace();

        switch ($face) {
            case 'NORTH':
                $face = 'WEST';
                break;
            case 'SOUTH':
                $face = 'EAST';
                break;
            case 'EAST':
                $face = 'NORTH';
                break;
            case 'WEST':
                $face = 'SOUTH';
                break;
        }

        $this->robotRepository->turn($face);
    }

    /**
     * 
     * @param array $options
     */
    private function setRight($options = array())
    {
        $face = $this->robot->getFace();

        switch ($face) {
            case 'NORTH':
                $face = 'EAST';
                break;
            case 'SOUTH':
                $face = 'WEST';
                break;
            case 'EAST':
                $face = 'SOUTH';
                break;
            case 'WEST':
                $face = 'NORTH';
                break;
        }

        $this->robotRepository->turn($face);
    }

    /**
     * Output the position of the robot
     * 
     * @param array $options
     * @return string
     */
    private function setReport($options = array())
    {
        return $this->robot->getX() . ',' . $this->robot->getY() . ',' . $this->robot->getFace();
    }

    /**
     * 
     * @param string $sentCommands
     * @return mixed Can return a message or just a false 
     */
    public function input($sentCommands)
    {
        $commands = explode(PHP_EOL, $sentCommands);
        
        foreach ($commands as $command) {
            
            $action = $this->getAction($command);
            $params = $this->getParams($command);
            
            if (!in_array($action, $this->actions))
                throw new \Exception($action . ' is an invalid command');

            $return = $this->setOption($action, $params);

            if (is_string($return))
                return $return;
        }

        return false;
    }

    /**
     * 
     * @param type $string
     * @return type
     */
    private function getAction($string)
    {
        $strings = explode(' ', $string);
        $string = trim(strtoupper($strings[0]));
        return $string;
    }

    /**
     * 
     * @param string $string
     * @return array
     */
    private function getParams($string)
    {
        $options = explode(',', strstr($string, ' '));
        
        for($i=0; $i < count($options); $i++)
            $options[$i] = trim(strtoupper ($options[$i]));
        
        return $options;
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


<?php

namespace Core\Controller;

/**
 * Action class.
 *
 * @author Renato Medina <medinadato@gmail.com>
 */
class Action extends \Zend_Controller_Action
{

    protected $em = null;

    public function init()
    {
        $this->em = \Zend_Registry::get('doctrine')->getEntityManager();
    }

    /**
     * Retrieve the Doctrine Container.
     *
     * @return Bisna\Doctrine\Container
     */
    public function getDoctrineContainer()
    {
        return $this->getInvokeArg('bootstrap')->getResource('doctrine');
    }

}
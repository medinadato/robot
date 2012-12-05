<?php

class IndexController extends \Core\Controller\Action
{

    public function indexAction()
    {
        // action body
        $blas = $this->em->getRepository('Application\Domain\Entity\Bla')->findAll();

        foreach ($blas as $bla) {
            echo $bla->getId() . '-' . $bla->getDescription() . '<br />';
        }
    }

}


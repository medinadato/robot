<?php

use Application\Forms\CommandLine as CommandLineForm,
    Application\Domain\Repository\Table as TableRepository;

class IndexController extends \Core\Controller\Action
{

    public function indexAction()
    {
        $form = new CommandLineForm();

        if ($this->getRequest()->isPost() && $form->isValid($_POST)) {
            extract($_POST);

            $tableRepository = new TableRepository;

            try {
                $return = $tableRepository->input($command);
            } catch (\Exception $e) {
                $return = $e->getMessage();
            }

            $this->view->return = $return;
        }

        $this->view->form = $form;
    }

}


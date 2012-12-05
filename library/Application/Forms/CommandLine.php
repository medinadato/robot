<?php

namespace Application\Forms;

/**
 * Description of CommandLine
 *
 * @author Renato Medina <medinadato@gmail.com>
 */
class CommandLine extends \Zend_Form
{

    public function init()
    {
        // form's attr
        $this->setAttribs(array(
            'id' => 'command-line-form',
            'method' => 'post',
        ));

        $this->addElement('textarea', 'command', array(
                    'label' => 'Input',
                    'cols' => 100,
                    'rows' => 8,
                    'required' => true,
                ))
                ->addElement('submit', 'submit', array(
                    'label' => 'Send',
                ))
                ->addDisplayGroup(
                        array(
                    'command', 'submit',
                        ), 'identification', array('legend' => 'Command Line')
        );
    }

}

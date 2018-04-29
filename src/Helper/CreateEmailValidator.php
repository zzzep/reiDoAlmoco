<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author Giuseppe Dezute Fechio <giuseppe.fechio@hotmail.com>
 */

namespace App\Helper;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class CreateEmailValidator extends Form {

    protected function _buildSchema(Schema $schema) {
        return $schema->addField('name', 'string')
                        ->addField('email', ['type' => 'string'])
                        ->addField('body', ['type' => 'text']);
    }

    protected function _buildValidator(Validator $validator) {
        return $validator->add('name', 'length', [
                    'rule' => ['minLength', 10],
                    'message' => 'Nome Inválido'
                ])->add('email', 'format', [
                    'rule' => 'email',
                    'message' => 'Email Inválido',
        ]);
    }

    protected function _execute(array $data) {
        return true;
    }

}

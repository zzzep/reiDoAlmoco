<?php

/**
 * Description of Email
 *
 * @author Giuseppe Dezute Fechio <giuseppe.fechio@hotmail.com>
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Database\Schema\SqliteSchema;
use Cake\Database\Driver\Sqlite;
use Cake\Core\Configure;

class EmailsList extends Table {
    /* public function __construct() {
      $config = Configure::read("datasources");
      parent::__construct($config);
      } */

    public function saveEmail($params) {
        $listModel = TableRegistry::get('emails_list');
        
        if (!isset($params["email"])){
            throw new \Exception("Parametros inválidos");
        }

        $emailExist = $listModel->find()->where('email = "' . $params["email"] . '"')->count();

        if ($emailExist > 0) {
            throw new \Exception("Email já cadastrado");
        }

        $entity = $listModel->newEntity();

        $entity->email = $params["email"];
        $entity->name = $params["name"];
        $entity->image = $params["imageText"];
        $entity->created = date("y-m-d");

        if ($listModel->save($entity)) {
            return $entity->id;
        }

        return false;
    }

    public function getEmailById($id) {
        $emails = TableRegistry::get('emails_list');
        $query = $emails->find()->where("id = $id")->toList();

        return $query;
    }

    public function getEmails() {
        $emails = TableRegistry::get('emails_list');

        $query = $emails
                ->find()
                ->toArray();

        return (array) $query;
    }

}

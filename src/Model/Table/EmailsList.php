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
    
    /*public function __construct() {
        $config = Configure::read("datasources");
        parent::__construct($config);
    }*/

    public function saveEmail($params) {
        $articlesTable = TableRegistry::get('emails_list');
        
        $entity = $articlesTable->newEntity();
        
        $entity->email = $params["email"];
        $entity->name = $params["name"];
        $entity->image = $params["imageText"];
        $entity->created = date("y-m-d");

        if ($articlesTable->save($entity)) {
            return $entity->id;
        }

        return false;
    }

}

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

class Votes extends Table {

    public function __construct() {
        $config = Configure::read("datasources");
        parent::__construct($config);
    }

    public function getTodayKing() {
        $votesTables = TableRegistry::get('votes');

        $query = $votesTables
                ->find()
                ->select(['email', 'name'])
                ->where(['created =' => date("y-m-d")])
                ->order(['created' => 'DESC']);
    }

    public function saveVote($id, $ip) {
        $votesTables = TableRegistry::get('votes');

        $entity = $votesTables->newEntity();

        $entity->email_id = $id;
        $entity->ip = $ip;

        if ($votesTables->save($entity)) {
            return $entity->id;
        }

        return false;
    }

}

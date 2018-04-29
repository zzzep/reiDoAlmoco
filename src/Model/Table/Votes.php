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

    public function getTodayKing() {
        $votesTables = TableRegistry::get('votes');

        $query = $votesTables
                ->find()
                ->select(['email', 'name'])
                ->where(['created =' => date("y-m-d")])
                ->order(['created' => 'DESC']);
    }

    public function worstKings() {
        $votesTables = TableRegistry::get('votes');

        $emails = (new EmailsList)->getEmails();
        foreach ($emails as $key => $email) {
            $votes = $votesTables->find()->where(["email_id" => $email["id"]])->count();
            $emails[$key]["votes"] = $votes;
        }
        
        $array = (array)$emails;
        $result = usort($array, function ($a, $b){
            return strcmp($a["votes"], $b["votes"]);
        });
        return $array;
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

    public function initialize(array $config) {
        $this->belongsTo('emails_list', [
                    'className' => 'Publishing.Authors'
                ])
                ->setForeignKey('authorid')
                ->setProperty('person');
    }

}

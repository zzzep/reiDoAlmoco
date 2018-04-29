<?php

/**
 * Description of Email
 *
 * @author Giuseppe Dezute Fechio <giuseppe.fechio@hotmail.com>
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\Model\Table\EmailsList;

class Votes extends Table {

    public function getTodayKing() {
        
        $votesTables = TableRegistry::get('votes');
        $date = '"%' . date("y-m-d") . '%"';
        $list = (new EmailsList())->getEmails();
        
        $competitors = [];
        foreach ($list as $email){
            $votes = $votesTables->find()->where("email_id = $email->id and created like $date")->count();   
            $competitors[$email->id] = [
                "email" => $email,
                "votes" => $votes
            ];
        }
        
        foreach ($competitors as $key => $value){
            if (!isset($winner)){
                $winner = $value;
            }
            if ($value["votes"] > $winner ["votes"]){
                $winner = $value;
            }
        }
        
        return $winner["email"];
        
    }

    public function worstKings() {
        $votesTables = TableRegistry::get('votes');

        $emails = (new EmailsList)->getEmails();
        foreach ($emails as $key => $email) {
            $votes = $votesTables->find()->where(["email_id" => $email["id"]])->count();
            $emails[$key]["votes"] = $votes;
        }
        
        $result = usort($emails, function ($a, $b){
            return strcmp($a["votes"], $b["votes"]);
        });
        return $emails;
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

<?php

/**
 * Description of Email
 *
 * @author Giuseppe Dezute Fechio <giuseppe.fechio@hotmail.com>
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class EmailsWinners extends Table {

    public function saveWinner($id) {
        $winnersTable = TableRegistry::get('email_winners');

        $entity = $winnersTable->newEntity();

        $entity->email_id = $id;
        $entity->win_date = date("y-m-d");

        if ($winnersTable->save($entity)) {
            return $entity->id;
        }

        return false;
    }

    public function lastWinner() {
        $winner = TableRegistry::get('email_winners')->find()->order("win_date desc")->toArray();
        $email = (new EmailsList)->getEmailById($winner[0]->email_id)[0];
        return ["name" => $email->name, "image" => $email->image];
    }

    public function getWeekWinners() {
        $winners = TableRegistry::get('email_winners')->find()->toArray();
        foreach ($winners as $winner) {
            $date = new \DateTime($winner->win_date);
            $week = $date->format("W");
            if (!isset($weekWinners[$week])) {
                $weekWinners[$week] = [];
            }
            if (!isset($weekWinners[$week][$winner->email_id])) {
                $weekWinners[$week][$winner->email_id] = 0;
            }
            $weekWinners[$week][$winner->email_id] ++;
            $weekWinnerId[$week] = array_keys($weekWinners[$week], max($weekWinners[$week]))[0];
        }

        $result = [];
        foreach ($weekWinnerId as $week => $winner) {
            $email = (new EmailsList)->getEmailById($winner)[0];
            $result[] = ["id" => 1, "week" => $week, "name" => $email->name, "email" => $email->email, "image" => $email->image];
        }
        usort($result, function ($b, $a) {
            return strcmp($a["week"], $b["week"]);
        });

        return $result;
    }

}

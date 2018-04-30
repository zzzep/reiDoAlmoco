<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helper;

use Cake\I18n\Time;

/**
 * Description of DateTime
 *
 * @author Giuseppe Dezute Fechio <giuseppe.fechio@hotmail.com>
 */
class DateTime {

    public static function current_time() {
        $dateTime = new Time();

        $currentDateTime = $dateTime->now("America/Sao_Paulo");

        return $currentDateTime->hour . ":" . $currentDateTime->minute . ":" . $currentDateTime->second;
    }

    public static function isBetweenTime($initial, $final, $real) {
        if ($real < $initial) {
            return false;
        }
        if ($real > $final) {
            return false;
        }
        return true;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helper;

use Cake\Mailer\Email as EmailSender;

/**
 * Description of email
 *
 * @author Giuseppe Dezute Fechio <giuseppe.fechio@hotmail.com>
 */
class Email {

    public function send($config = "default", $from = "naoresponda@reidoalmoco.com", $to = "rei@reidoalmoco.com", $subject = "Você é o rei hoje", $text = "Parabens!!!! <br> Você foi o rei de Hoje") {
        $emailSender = new EmailSender($config);
        $emailSender->setFrom([$from => 'Rei do Almoco'])
                ->setTo($to)
                ->setSubject($subject)
                ->send($text);
    }

}

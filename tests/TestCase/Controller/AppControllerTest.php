<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         1.2.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Test\TestCase\Controller;

use App\Controller\ApiController;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\IntegrationTestCase;
use Cake\View\Exception\MissingTemplateException;

/**
 * PagesControllerTest class
 */
class AppControllerTest extends IntegrationTestCase {

    /**
     * testGet method
     *
     * @return void
     */
    public function testGet() {
        $this->get('/');
        $this->assertResponseOk();
    }

    public function testValidsUrls() {
        $this->get("/");
        $this->assertResponseOk();
        $this->assertResponseContains('<html>');
        $this->assertResponseContains('Rei do Almoço');

        $this->get('/create-email');
        $this->assertResponseOk();
        $this->assertResponseContains('<html>');
        $this->assertResponseContains('Rei do Almoço');
    }

    public function testWinnerOfTheDay() {
        $this->get("/");
        $this->assertResponseOk();
        $this->assertResponseContains("Vencedor do Dia :");
    }

    public function testValidUrlCreateEmail() {
        $this->get("/create-email");
        $this->assertResponseOk();
        $this->assertResponseContains("Cadastro de Email");
        $this->assertResponseContains("Salvar");
    }

    public function testAccessHomeSeeTheWinner() {
        $this->get("/");

        $winnersModel = new \App\Model\Table\EmailsWinners();
        $weekWinners = $winnersModel->getWeekWinners();
        
        if (isset($weekWinners[0])) {
            $this->assertResponseContains($weekWinners[0]["name"]);
        } else {
            $this->assertResponseNotContains("Error");
        }
    }

    public function testAccessHomeSeeTheWorsts() {
        $this->get("/");

        $votesModel = new \App\Model\Table\Votes();
        $worst = $votesModel->worstKings();

        if (isset($worst[0])) {
            $this->assertResponseContains($worst[0]["name"]);
        } else {
            $this->assertResponseNotContains("Error");
        }
    }

    public function testImportsInHtml(){
        $this->get("/");
        $this->assertResponseContains("lib/jquery");
        $this->assertResponseContains("lib/bootstrap");
        $this->assertResponseContains("loading.gif");
    }
}

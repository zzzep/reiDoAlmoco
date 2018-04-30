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
class ApiControllerTest extends IntegrationTestCase {

    /**
     * testGet method
     *
     * @return void
     */
    public function testGet() {
        $this->get('/api/');
        $this->assertResponseOk();
    }

    /**
     * Test that missing template renders 404 page in production
     *
     * @return void
     */
    public function testMissingTemplate() {
        Configure::write('debug', false);
        $this->get('/pages/not_existing');

        $this->assertResponseError();
        $this->assertResponseContains('Error');
    }

    public function testValidsUrls() {
        $this->get("/api");
        $this->assertResponseOk();
        $this->assertJson("{}");

        $this->get("/api/create-email");
        $this->assertResponseOk();
        $this->assertJson("{}");

        $this->get("/api/send-email");
        $this->assertResponseOk();
        $this->assertJson("{}");

        $this->get("/api/vote");
        $this->assertResponseOk();
        $this->assertJson("{}");
    }

    public function testEmailCreation(){
        $this->post("/api/create-email", '{"email":"teste@teste.com","name":"teste","image":"none"}');
        $this->assertResponseOk();
        $this->assertJson("{}");
    }
    
    public function testValidVotationResponse(){
        $this->post("/api/vote", '{"id":"1"}');
        $this->assertResponseOk();
        $this->assertJson("{}");
    }
    
    public function testSendEmailResponse(){
        $this->post("/api/send-email");
        $this->assertResponseOk();
        $this->assertJson("{}");
    }

}

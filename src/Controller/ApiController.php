<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use App\Helper\CreateEmailValidator;
use App\Model\Entity\Json;
use App\Model\Table\EmailsList;
use App\Model\Table\Votes;
use App\Model\Table\EmailsWinners;
use App\Helper\Email;
use App\Helper\DateTime as helperTime;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class ApiController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->viewBuilder()->SetTemplate('json');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function index() {
        $response = [
            "error" => false,
            "code" => 200,
            "message" => [
                "validsUrls" => [
                    "GET" => [],
                    "POST" => [
                        '/api/vote',
                        '/api/send-email',
                        '/api/create-email'
                    ]
                ]
            ]
        ];
        $this->set("data", $response);
    }

    public function display() {
        $this->render('HomeApi');
    }

    public function createEmail() {
        try {
            $form = new CreateEmailValidator();
            $jsonData = (Array) $this->request->input('json_decode');
            $isValid = $form->validate($jsonData);
            if (!$isValid) {
                $this->treatErrors($form->errors());
            }
            $model = new EmailsList();
            $model->saveEmail($jsonData);
            $this->set("data", $this->setJsonResponse("Email Cadastrado"));
        } catch (\Exception $e) {
            $this->set("data", $this->setJsonResponse($e->getMessage(), 500, true));
        }
    }

    public function sendEmail() {
        try {
            if (helperTime::isBetweenTime(Configure::read("initial_time"), Configure::read("final_time"), helperTime::current_time())) {
                throw new \Exception("Ainda não está no horário de encerramento de votação");
            }
            $model = new Votes();
            $king = $model->getTodayKing();

            $winnerModel = new EmailsWinners();
            $winnerModel->saveWinner($king->id);

            (new Email())->send("default", "naoresponda@reidoalmoco.com", $king->email);
        } catch (\Exception $e) {
            $this->set("data", $this->setJsonResponse($e->getMessage()));
        }
    }

    public function vote() {
        try {
            if (!helperTime::isBetweenTime(Configure::read("initial_time"), Configure::read("final_time"), helperTime::current_time())) {
                $this->set("data", $this->setJsonResponse("Voto fora do horário estipulado"));
                return;
            }
            $jsonData = $this->request->input('json_decode');
            if (!isset($jsonData->id)) {
                throw new \Exception("Id não informado");
            }
            $model = new Votes();
            $model->saveVote($jsonData->id, $this->request->clientIp());
            $this->set("data", $this->setJsonResponse("Voto Confirmado"));
        } catch (\Exception $e) {
            $this->set("data", $this->setJsonResponse($e->getMessage(), 500, true));
        }
    }

    protected function treatErrors($allErrors) {
        $result = "";
        foreach ($allErrors as $errors) {
            foreach ($errors as $error) {
                $result .= $error;
            }
        }
        throw new \Exception($result);
    }

    protected function setJsonResponse($message, $code = 200, $error = false) {
        $response = new Json();
        $response->message = $message;
        $response->code = $code;
        $response->error = $error;
        return $response;
    }

}

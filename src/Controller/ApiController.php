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
use App\Helper\FieldsValidator;
use App\Model\Entity\Json;

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
                    "GET" => [
                        '/api/email-votes',
                        '/api/email-list',
                        '/api/win-of-the-week',
                        '/api/lasts-winners-of-the-week',
                        '/api/worst-kings',
                        '/api/win-of-the-day',
                        '/api/valid-hour',
                        '/api/last-winner'
                    ],
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
            $form = new FieldsValidator();
            $jsonData = (Array) $this->request->input('json_decode');
            $isValid = $form->validate($jsonData);
            if (!$isValid) {
                $this->treatErrors($form->errors());
            }

            $this->set("data", $this->setJsonResponse("Email Cadastrado"));
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

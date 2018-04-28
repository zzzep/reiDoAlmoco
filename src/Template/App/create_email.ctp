<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = "default";

?>

<?= $this->Html->script('createEmail.js') ?>

<h2 class="text-center give-me-space">Cadastro de Email</h2>

<form class="text-center" id="email-creation">
    <table class="table-light table-sm text-center table-responsive-sm table-condensed create-email">
        <tr>
            <td>Nome:</td>
            <td>
                <input type="text" name="name" value="" size="60" />
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" value="" size="60" />
            </td>
        </tr>
        <tr>
            <td>Foto:</td>
            <td>
                <input type="file" name="image" value="" width="60" />
            </td>
        </tr>
        <tfoot>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="submit" value="Salvar" name="save" class="btn btn-success" onclick="saveEmail()"/>
                    <input type="reset" value="Limpar" name="clear" class="btn btn-warning"/>
                </td>
            </tr>
        </tfoot>
    </table>
</form>
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

<?= $this->Html->css('home.css') ?>

<?= $this->Html->script('home.js') ?>

<div class="winner">
    Vencedor do Dia : 
    <?= $winnerOfTheDay["name"] ; ?>
    &nbsp;&nbsp;&nbsp;
    <img src="<?= $winnerOfTheDay["image"] ; ?>" class="img-winner">
    <br><br>
    <input type="submit" value="Enviar Email pro Vencedor" name="send_email" class="btn btn-success" onclick="sendEmailToWinner(<?= $winnerOfTheDay["id"] ?>);"/>
</div>
<h4 class="text-center">Competidores</h4>
<table class="table-responsive-lg table-bordered table-striped">
    <?php foreach ($competitors as $competitor){ ?>
    <tr>
        <td ><img src="<?= $competitor["image"] ; ?>" class="img-competitor max-100"></td>
        <td><?= $competitor["name"]; ?><br><?= $competitor["email"] ?></td>
        <td class="text-center middle max-100" >
            <input type="button" value="Votar" name="vote" class="button btn-info" onclick="vote(<?= $competitor["id"] ?>)"/>
        </td>
    </tr>
    <?php }?>
</table>

<h4 class="text-center">Últimos Reis</h4>
<table class="table-responsive-lg table-bordered table-striped">
    <?php foreach ($lastWinners as $winner){ ?>
    <tr>
        <td><?= $winner["week"] ?>º Semana</td>
        <td ><img src="<?= $winner["image"] ; ?>" class="img-competitor max-100"></td>
        <td><?= $winner["name"]; ?><br><?= $winner["email"] ?></td>
    </tr>
    <?php }?>
</table>

<h4 class="text-center">Reis Menos Amados</h4>
<table class="table-responsive-lg table-bordered table-striped">
    <?php 
        for ($key=0 ; $key <=4 ; $key++){
            if (!isset($worstKings[$key])) continue;
    ?>
    <tr>
        <td class="text-center" width="130px;"><?= $worstKings[$key]["position"] ?></td>
        <td><?= $worstKings[$key]["name"]; ?><br><?= $worstKings[$key]["email"] ?></td>
        <td ><img src="<?= $worstKings[$key]["image"] ; ?>" class="img-competitor max-100"></td>
        <td class="text-center" width="130px;"><?= $worstKings[$key]["votes"] ?></td>
    </tr>
    <?php }?>
</table>

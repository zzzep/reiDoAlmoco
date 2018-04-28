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
$competitors = [
    ["id" => 1, "name" => "Mandy", "email" => "123@email.com", "image" => "data"],
    ["id" => 2, "name" => "Zepp", "email" => "456@email.com", "image" => "data"],
    ["id" => 3, "name" => "Rooney", "email" => "789@email.com", "image" => "data"],
    ["id" => 4, "name" => "Carol", "email" => "0AB@email.com", "image" => "data"]
];

$lastWinners = [
    ["id" => 1, "week" => "3", "name" => "Mandy", "email" => "123@email.com", "image" => "data"],
    ["id" => 2, "week" => "2", "name" => "Zepp", "email" => "456@email.com", "image" => "data"],
    ["id" => 3, "week" => "1", "name" => "Rooney", "email" => "789@email.com", "image" => "data"]
];

$worstKings = [
    ["id" => 1, "position" => 1, "votes" => "7", "name" => "Carol", "email" => "123@email.com", "image" => "data"],
    ["id" => 2, "position" => 2, "votes" => "35", "name" => "Rooney", "email" => "456@email.com", "image" => "data"],
    ["id" => 3, "position" => 3, "votes" => "189", "name" => "Zepp", "email" => "789@email.com", "image" => "data"]    
];

$winnerOfTheDay = ["name" => "Demércio", "image" => "data"];
?>

<?= $this->Html->css('home.css') ?>

<?= $this->Html->script('home.js') ?>

<div class="winner">
    Vencedor do Dia : 
    <?= $winnerOfTheDay["name"] ; ?>
    &nbsp;&nbsp;&nbsp;
    <img src="<?= $winnerOfTheDay["image"] ; ?>" class="img-winner">
</div>
<h4 class="text-center">Competidores</h4>
<table class="table-responsive-lg table-bordered">
    <?php foreach ($competitors as $competitor){ ?>
    <tr>
        <td width="130px"><img src="<?= $competitor["image"] ; ?>" class="img-competitor max-100"></td>
        <td><?= $competitor["name"]; ?><br><?= $competitor["email"] ?></td>
        <td class="text-center middle max-100" width="130px">
            <input type="button" value="Votar" name="vote" class="button btn-info" onclick="vote(<?= $competitor["id"] ?>)"/>
        </td>
    </tr>
    <?php }?>
</table>

<h4 class="text-center">Últimos Reis</h4>
<table class="table-responsive-lg table-bordered">
    <?php foreach ($lastWinners as $winner){ ?>
    <tr>
        <td><?= $winner["week"] ?>º Semana</td>
        <td width="130px"><img src="<?= $winner["image"] ; ?>" class="img-competitor max-100"></td>
        <td><?= $winner["name"]; ?><br><?= $winner["email"] ?></td>
    </tr>
    <?php }?>
</table>

<h4 class="text-center">Reis Menos Amados</h4>
<table class="table-responsive-lg table-bordered">
    <?php foreach ($worstKings as $king){ ?>
    <tr>
        <td class="text-center" width="130px;"><?= $king["position"] ?></td>
        <td><?= $king["name"]; ?><br><?= $king["email"] ?></td>
        <td width="130px"><img src="<?= $winner["image"] ; ?>" class="img-competitor max-100"></td>
        <td class="text-center" width="130px;"><?= $king["votes"] ?></td>
    </tr>
    <?php }?>
</table>
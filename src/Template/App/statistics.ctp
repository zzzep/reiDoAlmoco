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
$votesToday = $allVotes = $votesThisWeek = [
    ["id" => 1, "position" => 1, "votes" => 456, "name" => "Mandy", "email" => "123@email.com", "image" => "data"],
    ["id" => 2, "position" => 2, "votes" => 189, "name" => "Zepp", "email" => "456@email.com", "image" => "data"],
    ["id" => 3, "position" => 3, "votes" => 35, "name" => "Rooney", "email" => "789@email.com", "image" => "data"],
    ["id" => 4, "position" => 4, "votes" => 7, "name" => "Carol", "email" => "0AB@email.com", "image" => "data"]
];

?>

<h2 class="text-center give-me-space">Relações</h2>

<h4 class="text-center">Votos Hoje</h4>
<table class="table-responsive-lg table-bordered table-striped">
    <?php foreach ($votesToday as $competitor){ ?>
    <tr>
        <td width="130px"><?= $competitor["position"] ; ?></td>
        <td width="130px"><img src="<?= $competitor["image"] ; ?>" class="img-competitor max-100"></td>
        <td><?= $competitor["name"]; ?><br><?= $competitor["email"] ?></td>
        <td width="130px"><?= $competitor["votes"] ; ?></td>
    </tr>
    <?php }?>
</table>
<h4 class="text-center">Votos Essa Semana</h4>
<table class="table-responsive-lg table-bordered table-striped">
    <?php foreach ($votesToday as $competitor){ ?>
    <tr>
        <td width="130px"><?= $competitor["position"] ; ?></td>
        <td width="130px"><img src="<?= $competitor["image"] ; ?>" class="img-competitor max-100"></td>
        <td><?= $competitor["name"]; ?><br><?= $competitor["email"] ?></td>
        <td width="130px"><?= $competitor["votes"] ; ?></td>
    </tr>
    <?php }?>
</table>
<h4 class="text-center">Votação Total</h4>
<table class="table-responsive-lg table-bordered table-striped">
    <?php foreach ($votesToday as $competitor){ ?>
    <tr>
        <td width="130px"><?= $competitor["position"] ; ?></td>
        <td width="130px"><img src="<?= $competitor["image"] ; ?>" class="img-competitor max-100"></td>
        <td><?= $competitor["name"]; ?><br><?= $competitor["email"] ?></td>
        <td width="130px"><?= $competitor["votes"] ; ?></td>
    </tr>
    <?php }?>
</table>


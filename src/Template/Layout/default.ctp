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

use Cake\Routing\Router;
use Cake\Core\Configure;

?>
<!DOCTYPE html>
<html>
    <head>
    <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
        <?= Configure::read("title") ?>
        </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('lib/bootstrap.min.css') ?>
    <?= $this->Html->css('lib/bootstrap-grid.min.css') ?>
    <?= $this->Html->css('lib/bootstrap-reboot.min.css') ?>

    <?= $this->Html->script('lib/jquery-3.3.1.min.js') ?>
    <?= $this->Html->script('base.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    </head>
    <body>
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><a href="#"><?= Configure::read("title") ?></a></h1>
                </li>
            </ul>
            <div class="top-bar-section">
                <ul class="right">
                    <li><a target="_self" href="<?php echo Router::url('/', true); ?>">Home</a></li>
                    <li><a target="_self" href="<?php echo Router::url('/statistics', true); ?>">Relatórios</a></li>
                    <li><a target="_self" href="<?php echo Router::url('/create-email', true); ?>">Cadastro de Email</a></li>
                </ul>
            </div>
        </nav>
    <?= $this->Flash->render() ?>
        <div class="container clearfix">
        <?= $this->fetch('content') ?>
        </div>
        <footer>
            <?= $this->Html->image('loading.gif',["id"=>"loading-image"]) ?>
        </footer>
    </body>
</html>

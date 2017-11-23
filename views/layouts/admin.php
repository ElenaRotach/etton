<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
?>
<div class="right-menu col-lg-2">
    <div id="sidebar" class="admin-menu">
        <div>
            <ul>
                <li><a href="/" class="active">Главная</a></li>
                <li><a href="/category/category/index">Категории</a></li>
                <li><a href="/product/product/index">Товары</a></li>
                <li><a href="/order/order/index">Заказы</a></li>
                <li><a href="/paragraph/paragraph/index">Товары заказов</a></li>
                <li><a href="/status/status/index">Статусы заказов</a></li>
            </ul>
        </div>
    </div>
</div>




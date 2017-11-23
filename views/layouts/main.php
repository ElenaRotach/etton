<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div id="header">
        <h1 id="logo"><a href="#">канцтовары</a></h1>
        <?php if (Yii::$app->user->isGuest) {
            echo '<div id="cart"><a href="/site/signup"  class="cart-link-user">Регистрация</a><br><a href="/site/login" class="cart-link-user">Вход</a> </div>';
        } else {
            echo '<div id="cart">' . '<a href="#" class="cart-link-user">Корзина</a>
            <div class="cl">&nbsp;</div>
            <span>Заказов: <strong>4</strong></span>
            &nbsp;&nbsp;
            <span>Сумма: <strong>$250.99</strong></span>
            <br>' .
            Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Выход (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout cart-link-user']
        )
        . Html::endForm() .
        '</div>';
        }
            //var_dump(Yii::$app->user->can('viewAdminPage'));exit();
        ?>

        <!-- Navigation -->
        <div id="navigation">
            <ul>
                <li><a href="#" class="active">Главная</a></li>
                <li><a href="#">Помощь</a></li>
                <li><a href="#">Профиль</a></li>
                <li><a href="#">Заказы</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
        </div>
        <!-- End Navigation -->
    </div>
<div class="right-menu col-lg-2">
    <div id="sidebar">

        <!-- Search -->
        <div class="box search">
            <h2>Поиск <span></span></h2>
            <div class="box-content">
                <form action="" method="post">

                    <label>Ключевое слово</label>
                    <input type="text" class="field" />

                    <label>Категория</label>
                    <select class="field">
                        <option value="">-- Выбрать категорию --</option>
                    </select>

                    <div class="inline-field">
                        <label>Цена от</label>
                        <select class="field small-field">
                            <option value="">10</option>
                        </select>
                        <label>до:</label>
                        <select class="field small-field">
                            <option value="">50</option>
                        </select>
                    </div>

                    <input type="submit" class="search-submit" value="Искать" />



                </form>
            </div>
        </div>
        <!-- End Search -->

        <!-- Categories -->
        <?= app\widgets\categoriesList\CategoriesListWidget::widget();?>
        <!-- End Categories -->

    </div>
    <!-- End Sidebar -->

</div>
    <div class="col-lg-10">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <div id="footer" class="col-lg-12">
        <p class="left">
            <a href="#">Главная</a>
            <span>|</span>
            <a href="#">Помощь</a>
            <span>|</span>
            <a href="#">Профиль</a>
            <span>|</span>
            <a href="#">Заказы</a>
            <span>|</span>
            <a href="#">Контакты</a>
        </p>
        <p class="right">
            &copy; 2017
        </p>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

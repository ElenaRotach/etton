<?php

use yii\helpers\Html;
?>

<div id="cart">
    <a href="#" class="cart-link-user">Корзина</a>
    <div class="cl">&nbsp;</div>
    <span>Заказов: <strong><?=$count?></strong></span>
    &nbsp;&nbsp;
    <span>Сумма: <strong><?=$sum?></strong></span>
    <br>
    <?php echo Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton(
    'Выход (' . Yii::$app->user->identity->username . ')',
    ['class' => 'btn btn-link logout cart-link-user']
    )
    . Html::endForm() ?>
</div>
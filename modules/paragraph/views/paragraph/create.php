<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\orderParagraph\models\OrderParagraph */

$this->title = 'Create Order Paragraph';
$this->params['breadcrumbs'][] = ['label' => 'Order Paragraphs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-paragraph-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\orderParagraph\models\OrderParagraph */

$this->title = 'Update Order Paragraph: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Paragraphs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-paragraph-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

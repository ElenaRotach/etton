<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\orderStatus\models\Status */

$this->title = 'Обновить статус: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Статус', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="order-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

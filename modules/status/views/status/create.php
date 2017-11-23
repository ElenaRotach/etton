<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\orderStatus\models\Status */

$this->title = 'Добавить статус';
$this->params['breadcrumbs'][] = ['label' => 'Статус', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

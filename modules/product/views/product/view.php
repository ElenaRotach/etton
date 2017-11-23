<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\category\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'удалить товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <img src='/img/<?=$model->img?>' style="height: 200px">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'id_category',
                'label' => 'категория',
                'encodeLabel' => false,
                'value' => $model->idCategory->name,
            ],
            'name',
            'description:ntext',
            'count',
            'price',
        ],
    ]) ?>

</div>

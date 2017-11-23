<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\category\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\category\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить категорию?',
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
                'attribute' => 'id_parent',
                'label' => 'родительская категория',
                'encodeLabel' => false,
                'value' => function (Category $model) {
                    return Category::find()->where(['id' => $model->id_parent])->asArray()->one()['name'];
                },
            ],
            'name',
            'description:ntext',

        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\category\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\category\models\CategorySearsh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'id_parent',
                'label' => 'родительская категория',
                'encodeLabel' => false,
                'content' => function (Category $model) {
                    return Category::find()->where(['id' => $model->id_parent])->asArray()->one()['name'];
                },
                'filterInputOptions' => [
                    'class' => 'form-control'
                ]
            ],
            'name',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

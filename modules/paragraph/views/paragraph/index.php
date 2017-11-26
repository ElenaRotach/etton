<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\product\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\orderParagraph\models\OrderParagraphSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пункт заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-paragraph-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить пункт к заказу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_order',
            //'id_product',
            [
                'attribute' => 'id_product',
                'label' => 'Товар',
                'encodeLabel' => false,
                'content' => function (Product $model) {
                    return Product::find()->where(['id' => $model->id_product])->asArray()->one()['name'];
                },
                'filterInputOptions' => [
                    'class' => 'form-control'
                ]
            ],
            'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

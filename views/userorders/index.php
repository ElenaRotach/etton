<!--<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#">Главная</a></li>
    <li><a href="#">Профиль</a></li>
    <li><a href="#">Сообщение</a></li>
</ul>-->
<?php
use yii\grid\GridView;
use app\modules\product\models\Product;
use yii\helpers\Html;
use \yii\helpers\Url;
?>
<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#active" data-toggle="tab">Активный заказ</a></li>
    <li class=""><a href="#orders" data-toggle="tab">Заказы</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade" id="active">
        <div>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [


                    'id',
                    'id_order',
                    //'id_product',
                    [
                        'attribute' => 'id_product',
                        'label' => 'Товар',
                        'encodeLabel' => false,
                        'content' => function (\app\modules\paragraph\models\Paragraph $model) {
                            return Product::find()->where(['id' => $model->id_product])->asArray()->one()['name'];
                        },
                        'filterInputOptions' => [
                            'class' => 'form-control'
                        ]
                    ],
                    'count',


                ],
            ]); ?>
        </div>
        <button class="btn btn-default">Подтвердить</button>
    </div>
    <div class="tab-pane fade active in" id="orders">
        <div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'class' => \yii\grid\ActionColumn::class,//\yii\grid\SerialColumn::class,
                        'options' => ['width' => 60],
                        'visibleButtons' => [
                                'view' => false,
                        ],
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', ['id' => $model->id, 'onclick' => 'test']);
                            },
                        ]
                    ],

                    [
                            'class' => \yii\grid\SerialColumn::class
                    ],
                    [
                        'label' => 'Изображение',
                        'format' => 'raw',
                        'value' => function($model){
                            $img = Product::find()->where(['id' => $model->id_product])->asArray()->one()['img'];
                            if($img===null){
                                $img = "img/default.jpg";
                            }else{
                                $img = "img/" .  $img;
                            }
                            return Html::img(Url::toRoute($img),[
                                'alt'=>'yii2 - картинка в gridview',
                                'style' => 'width:70px;'
                            ]);
                        },
                    ],
                    //'id_order',
                    [
                        'attribute' => 'id_order',
                        'label' => '№ Заказа'
                    ],
                    //'id_product',
                    [
                        'attribute' => 'id_product',
                        'label' => 'Товар',
                        'encodeLabel' => false,
                        'content' => function (\app\modules\paragraph\models\Paragraph $model) {
                            return Product::find()->where(['id' => $model->id_product])->asArray()->one()['name'];
                        },
                        'filterInputOptions' => [
                            'class' => 'form-control'
                        ]
                    ],
                    'count',
                    [
                            'attribute' => 'id_product.price',
                            'class' => \yii\grid\DataColumn::class,
                        'label' => 'Цена за шт.',

                        'content'=> function($model) {
                            Yii::$app->formatter->locale = 'ru-RU';
                            return Yii::$app->formatter->asCurrency(Product::findOne($model->id_product)->price);
                        }
                    ],

                    [
                        'attribute' => 'id_product.count',
                        'class' => \yii\grid\DataColumn::class,
                        'label' => 'В наличии',

                        'content'=> function($model) {
                            return Product::findOne($model->id_product)->count;
                        }
                    ],

                    [
                        'attribute' => 'id_product.count',
                        'class' => \yii\grid\DataColumn::class,
                        'label' => 'Сумма',

                        'content'=> function($model) {
                            return Yii::$app->formatter->asCurrency(Product::findOne($model->id_product)->price * $model->count);
                        }
                    ],

                ],
            ]); ?>
        </div>
    </div>
</div>

<script>
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
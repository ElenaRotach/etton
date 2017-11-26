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
use app\modules\status\models\Status;
use app\modules\paragraph\models\Paragraph;
?>
<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#active" data-toggle="tab">Активный заказ</a></li>
    <li class=""><a href="#orders" data-toggle="tab">Заказы</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade  active in" id="active">
        <div>
<?php
            if($dataProvider != null) {
                echo GridView::widget([
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
                            'value' => function ($model) {
                                $img = Product::find()->where(['id' => $model->id_product])->asArray()->one()['img'];
                                if ($img === null) {
                                    $img = "img/default.jpg";
                                } else {
                                    $img = "img/" . $img;
                                }
                                return Html::img(Url::toRoute($img), [
                                    'alt' => 'yii2 - картинка в gridview',
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

                            'content' => function ($model) {
                                Yii::$app->formatter->locale = 'ru-RU';
                                return Yii::$app->formatter->asCurrency(Product::findOne($model->id_product)->price);
                            }
                        ],

                        [
                            'attribute' => 'id_product.count',
                            'class' => \yii\grid\DataColumn::class,
                            'label' => 'В наличии',

                            'content' => function ($model) {
                                return Product::findOne($model->id_product)->count;
                            }
                        ],

                        [
                            'attribute' => 'id_product.count',
                            'class' => \yii\grid\DataColumn::class,
                            'label' => 'Сумма',

                            'content' => function ($model) {
                                return Yii::$app->formatter->asCurrency(Product::findOne($model->id_product)->price * $model->count);
                            }
                        ],

                    ],
                ]);

                echo Html::button('Подтвердить',['class'=>'btn btn-default']);
            }else{
                echo "<br><h2>Нет активных заказов</h2>";
            }

            ?>
        </div>

    </div>
    <div class="tab-pane fade" id="orders">
        <div>
            <?= GridView::widget([
                'dataProvider' => $ordersProvider,
                'filterModel' => $ordersSearch,
                'columns' => [
                    [
                        'class' => \yii\grid\SerialColumn::class
                    ],
                    //'status',
                    [
                        'attribute' => 'status',
                        'class' => \yii\grid\DataColumn::class,
                        'label' => 'Статус заказа',

                        'content'=> function($model) {
                            return Status::findOne(['id'=>$model->status])->name;
                        }
                    ],
                    //'created_at',
                    [
                        'attribute' => 'created_at',
                        'class' => \yii\grid\DataColumn::class,
                        'label' => 'Дата создания',

                        'content'=> function($model) {
                            return date('d.m.Y H:i:s', $model->created_at+3*60*60);
                        }
                    ],
                    //'update_at',
                    [
                        'attribute' => 'update_at',
                        'class' => \yii\grid\DataColumn::class,
                        'label' => 'Дата обновления',

                        'content'=> function($model) {
                            if($model->update_at != null){
                                return date('d.m.Y H:i:s', $model->update_at);
                            }else{
                                return '';
                            }

                        }
                    ],
                    //'confirmation_at',
                    [
                        'attribute' => 'confirmation_at',
                        'class' => \yii\grid\DataColumn::class,
                        'label' => 'Дата подтверждения',

                        'content'=> function($model) {
                            if($model->confirmation_at != null){
                                return date('d.m.Y H:i:s', $model->confirmation_at);
                            }else{
                                return '';
                            }

                        }
                    ],
                    //количество товаров
                    //'countParagraph'
                    [
                        'attribute' => 'countParagraph',
                        'class' => \yii\grid\DataColumn::class,
                        'label' => 'Количество товаров в заказе'
                    ],
                    //на сумму

                ]
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
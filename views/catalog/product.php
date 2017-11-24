    <?php

    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use app\models\ProductToBacket;

    if ($data->img === null) {
    $img = "/img/default.jpg";
    } else {
    $img = "/img/" . $data->img;
    }
    $btn =(Yii::$app->user->isGuest) ? 'disabled':'';
    $model = new ProductToBacket();
    $model->user = Yii::$app->user->getId();
    $model->product = $data->id;
    $form = ActiveForm::begin(['action' => '/userorders/addproduct?id=' . $data->id]);

    $form->field($model, 'user')->textInput();
    $form->field($model, 'product')->textInput();
    echo '<div class="col-lg-12 col-md-12 product">
            <div class="col-lg-12 col-md-12 product"><h1>' . $data->name . '</h1></div>
            <div class="col-lg-6 col-md-6">
                <img src="' . $img . '" alt="" />
            </div>
            <div class="col-lg-6 col-md-6 ">
                <p>' . $data->description . '</p>
                <hr>
                <strong class="price">Цена: ' . $data->price . ' руб.</strong>
                <strong class="price">В наличии: ' . $data->count . ' шт.</strong>
                <hr>
                <div class="col-lg-3 col-md-6">' .
                    Html::submitButton('В корзину', ['class' =>"btn btn-block  " . $btn]) .'
                </div>
            </div>
        </div>';
    ActiveForm::end(); ?>




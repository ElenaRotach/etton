
    <?php if ($data->img === null) {
    $img = "/img/default.jpg";
    } else {
    $img = "/img/" . $data->img;
    }
    $btn =(Yii::$app->user->isGuest) ? 'disabled':'';
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
                <div class="col-lg-3 col-md-6">
                    <button class="btn btn-block  ' . $btn . '">В корзину</button>
                </div>
            </div>
        </div>';
    ?>


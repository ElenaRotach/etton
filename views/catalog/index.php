<div class="products">
    <div class="cl">&nbsp;</div>
    <h1>Категории:</h1>
    <ul>
        <?php
        if(count($data[0])>0) {
            foreach ($data[0] as $cat) {
                if ($cat['img'] === null) {
                    $img = "/img/default.jpg";
                } else {
                    $img = "/img/" . $cat['img'];
                }
                echo '<li><a href="#"><img src="' . $img . '" alt="" /></a><div class="product-info"><h3><a href="/catalog/index?id=' . $cat["id"] . '" style="color:#fff;">' .
                    $cat['name'] . '</a></h3>
                        <div class="catalog-info product-desc">
                            <p>' . mb_strimwidth($cat['description'], 0, 50, "...") . '</p>
    
                        </div>
                    </div>
                </li>';

            }
        }else{
            echo 'Нет вложенных категорий';
        }
        ?>
    </ul>

    <div class="cl">&nbsp;</div>
    <h1>Товары:</h1>
    <ul>
        <?php
        if(count($data[1])>0) {
            foreach ($data[1] as $prod) {
                if ($prod['img'] === null) {
                    $img = "/img/default.jpg";
                } else {
                    $img = "/img/" . $prod['img'];
                }
                echo '<li><a href="#"><img src="' . $img . '" alt="" /></a><div class="product-info"><h3><a href="/catalog/product?id=' . $prod["id"] . '" style="color:#fff;">' .
                    $prod['name'] . '</a></h3>
                        <div class="catalog-info product-desc">
                            <p>' . mb_strimwidth($prod['description'], 0, 50, "...") . '</p>
                            <strong class="price">' . $prod['price'] . '</strong>
                        </div>
                    </div>
                </li>';

            }
        }else{
            echo 'Товары в категории отсутствуют';
        }
        ?>

    </ul>
</div>


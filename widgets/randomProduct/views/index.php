<div class="products">
    <div class="cl">&nbsp;</div>
    <ul>
    <?php
        foreach ($dataProvider as $d){
            if($d->img===null){
                $img = "img/default.jpg";
            }else{
                $img = "img/" .  $d->img;
            }
            echo '<li><a href="#"><img src="' . $img .'" alt="" /></a><div class="product-info"><h3><a href="/catalog/product/index?id=' . $d->id . '" style="color:#fff;">' .
                $d->name . '</a></h3></h3>
                    <div class="product-desc">
                        <p>' . $d->description . '</p>
                        <strong class="price">' . $d->price . '</strong>
                    </div>
                </div>
            </li>';

        }
    ?>
    </ul>
</div>

<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">


<?php echo \app\widgets\randomProduct\RandomProductWidget::widget(); ?>

    <div class="cols">
        <div class="cl">&nbsp;</div>
        <div class="col">
            <h3 class="ico ico1">Donec imperdiet</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
            <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
        </div>
        <div class="col">
            <h3 class="ico ico2">Donec imperdiet</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
            <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
        </div>
        <div class="col">
            <h3 class="ico ico3">Donec imperdiet</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
            <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
        </div>
        <div class="col col-last">
            <h3 class="ico ico4">Donec imperdiet</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec imperdiet, metus ac cursus auctor, arcu felis ornare dui.</p>
            <p class="more"><a href="#" class="bul">Lorem ipsum</a></p>
        </div>
        <div class="cl">&nbsp;</div>
    </div>
</div>

<div class="box categories">
    <h2>Категории <span></span></h2>
    <div class="box-content">
        <ul>
            <?php
                $data = $dataProvider->asArray()->all();
                foreach ($data as $category){

                    echo '<li data-id="' . $category['id'] . '"><a href="/catalog/index?id=' . $category['id'] .  '" title="' . $category['description'] . '">' . $category['name'] . '</a></li>';
                }
            ?>
            <!--<li><a href="#">Ручки</a></li>
            <li><a href="#">Карандаши</a></li>
            <li class="last"><a href="#">Тетради</a></li>-->
        </ul>
    </div>
</div>
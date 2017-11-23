<?php

use app\widgets\categoriesList\CategoriesListWidget;

?>

<div class="right-menu col-lg-2">
    <div id="sidebar">

        <!-- Search -->
        <div class="box search">
            <h2>Поиск <span></span></h2>
            <div class="box-content">
                <form action="" method="post">

                    <label>Ключевое слово</label>
                    <input type="text" class="field" />

                    <label>Категория</label>
                    <select class="field">
                        <option value="">-- Выбрать категорию --</option>
                    </select>

                    <div class="inline-field">
                        <label>Цена от</label>
                        <select class="field small-field">
                            <option value="">10</option>
                        </select>
                        <label>до:</label>
                        <select class="field small-field">
                            <option value="">50</option>
                        </select>
                    </div>

                    <input type="submit" class="search-submit" value="Искать" />



                </form>
            </div>
        </div>
        <!-- End Search -->

        <!-- Categories -->
        <?php
        echo CategoriesListWidget::widget();
        ?>
        <!-- End Categories -->

    </div>
    <!-- End Sidebar -->

</div>
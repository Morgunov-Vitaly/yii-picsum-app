<?php

/** @var yii\web\View $this */

use yii\grid\GridView;

$this->title = 'Панель управления';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Администрирование картинок</h1>
    </div>

    <div class="body-content">
        <?php

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            //'columns' => [
            //    'id',
            //    'extId',
            //    'isApproved',
            //    'url'
            //],
        ]);
        ?>
    </div>
</div>

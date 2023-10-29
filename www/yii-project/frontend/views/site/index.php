<?php

/** @var yii\web\View $this */

/** @var ImageRates $model */

use frontend\models\ImageRates;

$this->title = 'Оцени картинку';
$model = null;
?>
<div class="site-index">
    <div class="p-1 mb-0 pb-0 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Оцени картинку #<?= $model?->extId ?? '-' ?></h1>
            <p class="fs-5 fw-light">URL: <?= $model?->url ?? '-' ?></p>
            <img src="https://fastly.picsum.photos/id/251/800/600.jpg?hmac=gcV5mCKoVtGs6RxXBv8YvAxqkTRkS27_Jg_p6t5nJog" class="img-fluid" alt="Responsive image">
        </div>
    </div>

    <div class="body-content">
        <div class="row text-center">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-1">
                <p><a class="btn btn-lg btn-outline-secondary" href="/prev">Пред.</a></p>
            </div>
            <div class="col-lg-2">
                <p><a class="btn btn-lg btn-success" href="/approve">Нравится</a></p>
            </div>
            <div class="col-lg-2 right-align">
                <p><a class="btn btn-lg btn-danger" href="/reject">Не нравится</a></p>
            </div>
            <div class="col-lg-1">
                <p><a class="btn btn-lg btn-outline-secondary" href="/next">След.</a></p>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
    </div>
</div>

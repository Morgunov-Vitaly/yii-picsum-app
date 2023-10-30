<?php

/** @var yii\web\View $this */

/** @var ImageRates $model */

use frontend\models\ImageRates;
use yii\web\View;

$this->title = 'Оцени картинку';
$model = null;
?>
<div class="site-index">
    <div class="p-1 mb-0 pb-0 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Оцени картинку #<span id="image-id"></span></h1>
            <p id="image-url" class="fs-5 fw-light"> </p>
            <img id="image"
                 src="https://picsum.photos/800/600"
                 class="img-fluid" alt="Responsive image">
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
                <p><a id="btn-like" class="btn btn-lg btn-success" href="/approve">Нравится</a></p>
            </div>
            <div class="col-lg-2 right-align">
                <p><a id="btn-dislike" class="btn btn-lg btn-danger" href="/reject">Не нравится</a></p>
            </div>
            <div class="col-lg-1">
                <p><a id="btn-next" class="btn btn-lg btn-outline-secondary" href="/next">След.</a></p>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

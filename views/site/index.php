<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Index';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Aplikasi Tes Online</h1>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['start']) ?>">Buat Jadwal</a></p>
    </div>
</div>

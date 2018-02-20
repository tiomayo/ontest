<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Soal */

$this->title = 'Create Soal';
$this->params['breadcrumbs'][] = ['label' => 'Soal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?= $this->title ?></h4>
</div>
<div class="soal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Soal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-body">
    <div class="soal-form">

        <?php $form = ActiveForm::begin(['id' => 'soal-form',
                'enableAjaxValidation' => true]); ?>

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'soal')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'kunci_jawaban')->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'pilihan_A')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'pilihan_B')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'pilihan_C')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'pilihan_D')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
    </div>
</div>

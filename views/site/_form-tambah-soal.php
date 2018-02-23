<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Tambah Soal';
/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><?= $this->title ?></h4>
</div>
<div class="modal-body">
	<?php $form = ActiveForm::begin(['id' => 'soal-form', 'enableAjaxValidation' => true]); ?>

		<div class="row">
            <div class="col-lg-8">
                <?= $form->field($soal, 'soal')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($soal, 'kunci_jawaban')->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($soal, 'pilihan_A')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($soal, 'pilihan_B')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($soal, 'pilihan_C')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($soal, 'pilihan_D')->textarea(['rows' => 6]) ?>
            </div>
        </div>

		<div class="form-group text-center">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
</div>
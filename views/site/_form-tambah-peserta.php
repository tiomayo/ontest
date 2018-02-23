<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Tambah Peserta';
/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><?= $this->title ?></h4>
</div>
<div class="modal-body">
	<?php $form = ActiveForm::begin(['id' => 'peserta-form', 'enableAjaxValidation' => true]); ?>

		<?= $form->field($peserta, 'username')->textInput(['maxlength' => true]) ?>

		<?= $form->field($peserta, 'nama')->textInput(['maxlength' => true]) ?>

	    <div class="form-group text-center">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
</div>
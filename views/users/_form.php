<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modal-body">

	<div class="users-form">

	    <?php $form = ActiveForm::begin(['id' => 'user-form',
	                'enableAjaxValidation' => true]); ?>

	    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>

</div>
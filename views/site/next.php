<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

$this->title = 'Tambah Soal';
/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper2").on("afterInsert", function(e, soal) {
    jQuery(".dynamicform_wrapper2 .panel-title-soal").each(function(indexsoal) {
        jQuery(this).html("Soal: " + (indexsoal + 1))
    });
});

jQuery(".dynamicform_wrapper2").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper2 .panel-title-soal").each(function(indexsoal) {
        jQuery(this).html("Soal: " + (indexsoal + 1))
    });
});
';

$this->registerJs($js);
?>
<h3 class="form-title font-green"><?= $this->title ?></h3>

<?php $form = ActiveForm::begin(['id' => 'detail-form']); ?>

	<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper2',
        'widgetBody' => '.container-soal',
        'widgetItem' => '.soal-item',
        'limit' => 20,
        'min' => 1,
        'insertButton' => '.tambah-soal',
        'deleteButton' => '.hapus-soal',
        'model' => $soal[0],
        'formId' => 'detail-form',
        'formFields' => [
            'soal',
            'pilihan_A',
            'pilihan_B',
            'pilihan_C',
            'pilihan_D',
            'kunci_jawaban'
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-book"></i> Soal
            <button type="button" class="pull-right tambah-soal btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Soal</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-soal"><!-- widgetContainer -->
            <?php foreach ($soal as $indexsoal => $s): ?>
                <div class="soal-item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-soal">Soal: <?= ($indexsoal + 1) ?></span>
                        <button type="button" class="pull-right hapus-soal btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$s->isNewRecord) {
                                echo Html::activeHiddenInput($s, "[{$indexsoal}]id");
                            }
                        ?>
                        <div class="row">
	                        <div class="col-lg-9">
		                        <?= $form->field($s, "[{$indexsoal}]soal", ['enableAjaxValidation' => true])->label(false)->textInput(['maxlength' => true, 'placeholder' => 'Soal']) ?>
		                    </div>
	                        <div class="col-lg-3">
		                        <?= $form->field($s, "[{$indexsoal}]kunci_jawaban", ['enableAjaxValidation' => true])->label(false)->dropDownList([ 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', ], ['prompt' => '--Kunci Jawaban--']) ?>
		                    </div>
		                </div>
	                    <div class="row">
	                        <div class="col-lg-3">
			                    <?= $form->field($s, "[{$indexsoal}]pilihan_A", ['enableAjaxValidation' => true])->label(false)->textarea(['rows' => 6, 'placeholder' => 'Jawaban A']) ?>
			                </div>
			                <div class="col-lg-3">
			                    <?= $form->field($s, "[{$indexsoal}]pilihan_B", ['enableAjaxValidation' => true])->label(false)->textarea(['rows' => 6, 'placeholder' => 'Jawaban B']) ?>
			                </div>
			                <div class="col-lg-3">
			                    <?= $form->field($s, "[{$indexsoal}]pilihan_C", ['enableAjaxValidation' => true])->label(false)->textarea(['rows' => 6, 'placeholder' => 'Jawaban C']) ?>
			                </div>
			                <div class="col-lg-3">
			                    <?= $form->field($s, "[{$indexsoal}]pilihan_D", ['enableAjaxValidation' => true])->label(false)->textarea(['rows' => 6, 'placeholder' => 'Jawaban D']) ?>
			                </div>
			            </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

<div class="form-actions text-center">
    <?= Html::submitButton('Simpan', ['class' => 'btn btn-success', 'id'=>'next-button-1']) ?>
</div>

<?php ActiveForm::end(); ?>
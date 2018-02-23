<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
use wbraganca\dynamicform\DynamicFormWidget;

$this->title = 'Atur Jadwal dan Peserta';
/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, peserta) {
    jQuery(".dynamicform_wrapper .panel-title-peserta").each(function(index) {
        jQuery(this).html("Peserta: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-peserta").each(function(index) {
        jQuery(this).html("Peserta: " + (index + 1))
    });
});';
$this->registerJs($js);
?>
<h3 class="form-title font-green"><?= $this->title ?></h3>

<?php $form = ActiveForm::begin(['id' => 'jadwal-form', 'enableAjaxValidation' => true]); ?>

<div class="row">

    <div class="col-lg-6">

        <?= $form->field($jadwal, 'waktu_tes')->widget(DateTimePicker::classname(), [
        			'name' => 'datetime_start',
                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                    'options' => ['placeholder' => 'Waktu Mulai'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                    ]
              ])->label(''); ?>

        <?= $form->field($jadwal, 'waktu_selesai')->widget(DateTimePicker::classname(), [
        			'name' => 'datetime_finish',
                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                    'options' => ['placeholder' => 'Waktu Selesai'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                    ]
              ])->label(''); ?>

        <?= $form->field($jadwal, 'instruksi')->textarea(['rows' => 6, 'placeholder' => 'Instruksi'])->label(''); ?>

    </div>

    <div class="col-lg-6">

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.container-peserta',
            'widgetItem' => '.peserta', 
            'limit' => 20,
            'min' => 1,
            'insertButton' => '.add-peserta',
            'deleteButton' => '.remove-peserta',
            'model' => $peserta[0],
            'formId' => 'jadwal-form',
            'formFields' => [
                'username',
                'nama'
            ],
        ]); ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-user"></i> Peserta
                    <button type="button" class="pull-right add-peserta btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Peserta</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body container-peserta"><!-- widgetContainer -->
                    <?php foreach ($peserta as $index => $p): ?>
                        <div class="peserta panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <span class="panel-title-peserta">Peserta: <?= ($index + 1) ?></span>
                                <button type="button" class="pull-right remove-peserta btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                    // necessary for update action.
                                    if (!$p->isNewRecord) {
                                        echo Html::activeHiddenInput($p, "[{$index}]id");
                                    }
                                ?>
                                <?= $form->field($p, "[{$index}]username", ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
                                <?= $form->field($p, "[{$index}]nama", ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php DynamicFormWidget::end(); ?>

    </div>

    <div class="form-actions text-center">
        <?= Html::submitButton('Next', ['class' => 'btn btn-success']) ?>
    </div>

</div>
<?php ActiveForm::end(); ?>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\grid\GridView;

$gridColumns = [
	['class' => 'kartik\grid\CheckboxColumn'],
	'soal',
	'kunci_jawaban',
];

/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwal-form">

    <div class="col-lg-4">

    	<?php $form = ActiveForm::begin(['id' => 'jadwal-form',
        	'enableAjaxValidation' => true,]); ?>

	    <?= $form->field($model, 'waktu_tes')->widget(DateTimePicker::classname(), [
	    			'name' => 'datetime_start',
	                'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
	                'options' => ['placeholder' => 'Waktu Mulai'],
	                'pluginOptions' => [
	                    'autoclose'=>true,
	                ]
	          ]); ?>

	    <?= $form->field($model, 'waktu_selesai')->widget(DateTimePicker::classname(), [
	    			'name' => 'datetime_finish',
	                'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
	                'options' => ['placeholder' => 'Waktu Selesai'],
	                'pluginOptions' => [
	                    'autoclose'=>true,
	                ]
	          ]); ?>

	    <?= $form->field($model, 'instruksi')->textarea(['rows' => 6]) ?>

	</div>

	<div class="col-lg-8">
		<?= GridView::widget([
		    'dataProvider' => $dataProvider,
		    'columns' => $gridColumns,
		    'toolbar' =>  [
		        ['content' => 
		            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/soal/create'], ['type' => 'btn btn-success', 'title' => 'Tambah Soal', 'class' => 'btn btn-success', 'data-toggle' =>'modal', 'data-target'=>'#modal-soal'])
		        ],
		    ],
		    'panel' => [
		        'type' => GridView::TYPE_PRIMARY,
		        'heading' => '<i class="glyphicon glyphicon-book"></i>  Soal',
		    ],
    	])?>
	</div>

	<div class="col-lg-12">

	</div>
	<div class="col-lg-12">
		<div class="form-group pull-right">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id'=>'next-button-1']) ?>
	    </div>
	    <?php ActiveForm::end(); ?>
	</div>
</div>
<div class="modal fade bs-modal-lg" id="modal-soal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

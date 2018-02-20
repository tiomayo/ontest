<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Tambah Ujian';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
	[
    'class' => 'kartik\grid\SerialColumn',
    'width' => '36px',
    'header' => '',
	],
	['class' => 'kartik\grid\CheckboxColumn'],
	'username',
];

$gridColumnSoal = [
	['class' => 'kartik\grid\CheckboxColumn'],
	'soal',
	'kunci_jawaban',
];

$this->registerJs('
	$("#next-button").on("click",function() {
		var keys = $("#gridview-user").yiiGridView("getSelectedRows");
		$.post({
			url: "'.Url::to(['save-ujian']).'",
			dataType: "json",
			data: {peserta: keys},
		});
    });
    $(document).ready(function() {
	    $(".modal").on("hidden.bs.modal", function(e) {
			$(this).removeData();
	    });
	});
')
?>
<div class="row">
	<div class="col-lg-4">

    	<?php $form = ActiveForm::begin(['id' => 'jadwal-form','enableAjaxValidation' => true]); ?>

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
	<div class="col-lg-4">
		<div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id'=>'next-button-1']) ?>
	    </div>
	    <?php ActiveForm::end(); ?>
	</div>
</div>
<div class="row">
	<div class="users-create">
	    <div class="col-lg-6">
	    	<?= GridView::widget([
	    		'id' => 'gridview-user',
			    'dataProvider' => $dataProvider,
			    'columns' => $gridColumns,
			    'toolbar' =>  [
			        ['content' => 
			            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/users/create'], ['type' => 'btn btn-success', 'title' => 'Tambah Soal', 'class' => 'btn btn-success', 'data-toggle' =>'modal', 'data-target'=>'#modal-soal'])
			        ],
			    ],
			    'panel' => [
			        'type' => GridView::TYPE_PRIMARY,
			        'heading' => '<i class="glyphicon glyphicon-user"></i>  Peserta',
			    ],
	    	])?>
	    </div>
	</div>
	<div class="col-lg-6">
		<?= GridView::widget([
		    'dataProvider' => $dataProviderSoal,
		    'columns' => $gridColumnSoal,
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
</div>
<div class="modal fade bs-modal-lg" id="modal-soal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

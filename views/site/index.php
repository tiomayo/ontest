<?php

use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Index';
?>
<div class="site-index">
	<?php if ($dataProvider) { ?>
		<h3 class="form-title font-green">Selamat datang, <?= Yii::$app->user->identity->username ?>!</h3>
		<div class="panel panel-primary">
			<div class="panel-heading">
                <i class="glyphicon glyphicon-book"></i> Daftar Tes Online
                <a class="pull-right btn btn-success btn-xs" href="<?= Url::to(['start']) ?>"><i class="glyphicon glyphicon-plus"></i> Tambah Jadwal</a>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
            	<?php Pjax::begin(['enablePushState' => false]); ?>

				<?= GridView::widget([
			        'dataProvider' => $dataProvider,
			        'summary'=>'',
			        'columns' => [
			            [
			            	'class' => 'yii\grid\SerialColumn',
			            	'header'=>'',
			            	'contentOptions' => ['class' => 'text-center', 'style' => 'width: 5%'],
						    'headerOptions' => ['class' => 'text-center']
			            ],
			            [
			            	'attribute' => 'waktu_tes',
			            	'label' => 'Waktu Mulai',
			            	'headerOptions' => ['class' => 'text-center'],
			            	'contentOptions' => ['class' => 'text-center'],
			            	'format' => 'datetime'
			            ],
			            [
			            	'attribute' => 'waktu_selesai',
			            	'headerOptions' => ['class' => 'text-center'],
			            	'contentOptions' => ['class' => 'text-center'],
			            	'format' => 'datetime'
			            ],
			            [
			            	'label' => 'Durasi',
			            	'headerOptions' => ['class' => 'text-center'],
			            	'contentOptions' => ['class' => 'text-center'],
			            	'format' => 'raw',
						    'value' => function ($model) {
						    	return $model->getDurasi($model->waktu_tes,$model->waktu_selesai);
						    }
			            ],
			            [
			            	'label' => 'Jumlah Peserta',
			            	'contentOptions' => ['class' => 'text-center', 'style' => 'width: 15%'],
						    'headerOptions' => ['class' => 'text-center'],
						    'format' => 'raw',
						    'value' => function ($model) {
						    	return $model->getJumlahPeserta($model->id);
						    }
			            ],
			            [
			            	'label' => 'Jumlah Soal',
			            	'contentOptions' => ['class' => 'text-center', 'style' => 'width: 15%'],
						    'headerOptions' => ['class' => 'text-center'],
						    'value' => function ($model) {
						    	return $model->getJumlahSoal($model->id);
						    }
			            ],

			            [
			            	'class' => 'yii\grid\ActionColumn',
			            	'contentOptions' => ['class' => 'text-center', 'style' => 'width: 10%'],
						    'headerOptions' => ['class' => 'text-center'],
						    'template' => '{view} {delete}',
			            ],
			        ],
			    ]); ?>

			    <?php Pjax::end(); ?>
		   	</div>
		</div>
	<?php } else { ?>
    <div class="jumbotron">
        <h1>Aplikasi Tes Online</h1>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['start']) ?>">Buat Jadwal</a></p>
    </div>
    <?php } ?>
</div>

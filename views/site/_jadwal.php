<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */

$this->title = 'Detail Tes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-create">
	<?php if (Yii::$app->session->hasFlash('fail')): ?>
	<div class="row">
	    <div class="col-xs-12">
	        <div class="alert alert-warning alert-dismissable">
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				<h4><i class="icon fa fa-exclamation-triangle"></i> Error !</h4>
				<?= Yii::$app->session->getFlash('fail') ?>
	        </div>
	    </div>
	</div>
	<?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formjadwal', [
        'model' => $model,
        'soal' => $soal,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
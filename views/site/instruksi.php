<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Instruksi';
header( "refresh:180;url=".Url::to(['mulaites', 'id'=>$jadwal->id]) );
?>
<h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>
<p><?= \Yii::$app->formatter->asNtext($jadwal->instruksi) ?></p>

<div class="form-actions text-center">
	<?= Html::a('Mulai Tes', ['mulaites', 'id'=>$jadwal->id], ['class' => 'btn btn-success btn-xs'])?>
</div>
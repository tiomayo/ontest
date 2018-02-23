<?php

use yii\helpers\Html;
use yii\helpers\Url;

$i=1;
$this->title = 'Lembar Ujian';
?>
<h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>

<table class="table table-striped">
	<?php foreach ($soal as $s) { ?>
		<tr>
			<th colspan="4"><?= $i.'. '.$s->soal ?></th>
			<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->soal.'-'.$i ?>"><?= $s->pilihan_A ?></label></td>
			<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->soal.'-'.$i ?>"><?= $s->pilihan_B ?></label></td>
			<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->soal.'-'.$i ?>"><?= $s->pilihan_C ?></label></td>
			<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->soal.'-'.$i ?>"><?= $s->pilihan_D ?></label></td>
		</tr>
	<?php $i++; } ?>
</table>

<div class="form-actions text-center">
    <?= Html::submitButton('Selesai', ['class' => 'btn btn-success', 'id'=>'button-selesai']) ?>
</div>
<?php

use yii\helpers\Html;
use yii\helpers\Url;

$i=1;
$this->title = 'Lembar Ujian';
?>
<h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>

<form id="soal" method="POST" action="<?=Url::to(['save-hasil', 'id'=>$jadwal->id]) ?>">
	<table class="table table-striped">
		<?php foreach ($soal as $s) { ?>
			<tr id="soal-<?= $i ?>">
				<th colspan="4"><?= $i.'. '.$s->soal ?></th>
				<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->id ?>" value="A"><?= $s->pilihan_A ?></label></td>
				<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->id ?>" value="B"><?= $s->pilihan_B ?></label></td>
				<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->id ?>" value="C"><?= $s->pilihan_C ?></label></td>
				<td><label class="radio-inline"><input type="radio" name="<?= 'jawaban-'.$s->id ?>" value="D"><?= $s->pilihan_D ?></label></td>
			</tr>
		<?php $i++; } ?>
	</table>

	<div class="form-actions text-center">
	    <?= Html::submitButton('Selesai', ['class' => 'btn btn-success', 'id'=>'button-selesai']) ?>
	</div>
</form>
<script>
$(document).ready(function(){
    $('#soal').on('submit', function(e){
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var data = $("input:radio[name='jawaban']:checked").val();
        $.ajax({
            type: "POST",
            url: '<?= Url::to(['save-hasil', 'id' => $jadwal->id]) ?>',
            data: $('#soal').serialize(),
            success: function(data){
                alert(data);
            }
        });
    });
});
</script>
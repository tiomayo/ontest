<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jadwal */

$this->title = 'Detail Tes Online';
?>
<div class="jadwal-view">

    <h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-lg-4">
            <table class="table table-striped">
                <tr>
                    <th>Waktu Tes</th>
                    <td><?= \Yii::$app->formatter->asDatetime($jadwal->waktu_tes) ?></td>
                </tr>
                <tr>
                    <th>Waktu Selesai</th>
                    <td><?= \Yii::$app->formatter->asDatetime($jadwal->waktu_selesai) ?></td>
                </tr>
                <tr>
                    <th>Durasi</th>
                    <td><?= $jadwal->getDurasi($jadwal->waktu_tes,$jadwal->waktu_selesai) ?></td>
                </tr>
                <tr>
                    <th colspan="2" class="text-center">Instruksi</th>
                </tr>
                <tr>
                    <td colspan="2"><?= \Yii::$app->formatter->asNtext($jadwal->instruksi) ?></td>
                </tr>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-user"></i> Peserta
                    <button type="button" class="pull-right add-peserta btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Peserta</button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                    <?php $i=1; foreach ($daftarPeserta->models as $p): ?>
                        <tr>
                            <th class="text-center"><?= $i.'.' ?></th>
                            <td><?= $p->username ?></td>
                            <td><?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['/users/delete', 'id' => $p->id], ['class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure you want to delete?', 'data-method' => 'post', 'data-pjax' => '0',]) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;

$gridColumns = [
    'nama',
    'username',
    'password',
];
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
        <div class="col-lg-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-user"></i> Peserta
                    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Peserta', ['tambah-peserta','id' => $jadwal->id], ['class' => 'pull-right add-soal btn btn-success btn-xs','data-pjax' => 0, 'data-toggle' =>'modal', 'data-target'=>'#modal-tambah-peserta', 'id'=>'tombol-tambah-peserta'])?>
                    <?= ExportMenu::widget([
                        'dataProvider' => $daftarPeserta,
                        'columns' => $gridColumns,
                        'target' => ExportMenu::TARGET_SELF,
                        'container' => ['class'=>'pull-right'],
                        'dropdownOptions'=> ['class' => 'btn btn-success btn-xs', 'label' => ' Export'],
                        'columnSelectorOptions' => ['class' => 'hide']
                    ]); ?>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th></th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">E-Mail</th>
                            <th></th>
                        </tr>
                    <?php $i=1; foreach ($daftarPeserta->models as $p): ?>
                        <tr>
                            <th class="text-center"><?= $i.'.' ?></th>
                            <td><?= $p->nama ?></td>
                            <td><?= $p->username ?></td>
                            <td><?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['/users/delete', 'id' => $p->id], ['class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure you want to delete?', 'data-method' => 'post', 'data-pjax' => '0',]) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-book"></i> Soal
                    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Soal', ['tambah-soal','id' => $jadwal->id], ['class' => 'pull-right add-soal btn btn-success btn-xs','data-pjax' => 0, 'data-toggle' =>'modal', 'data-target'=>'#modal-tambah-soal', 'id'=>'tombol-tambah-soal'])?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Soal</th>
                            <th class="text-center">Pilihan A</th>
                            <th class="text-center">Pilihan B</th>
                            <th class="text-center">Pilihan C</th>
                            <th class="text-center">Pilihan D</th>
                            <th class="text-center"></th>
                        </tr>
                    <?php $i=1; foreach ($daftarSoal->models as $s): ?>
                        <tr>
                            <th class="text-center"><?= $i.'.' ?></th>
                            <td><?= $s->soal ?></td>
                            <td><?= $s->pilihan_A ?></td>
                            <td><?= $s->pilihan_B ?></td>
                            <td><?= $s->pilihan_C ?></td>
                            <td><?= $s->pilihan_D ?></td>
                            <td><?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['/soal/delete', 'id' => $s->id], ['class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure you want to delete?', 'data-method' => 'post', 'data-pjax' => '0',]) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-modal-lg" id="modal-tambah-peserta">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
        </div>
    </div>
</div>
<div class="modal fade bs-modal-lg" id="modal-tambah-soal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        </div>
    </div>
</div>
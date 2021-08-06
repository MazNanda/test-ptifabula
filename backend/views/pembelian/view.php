<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use pa3py6aka\yii2\ModalAlert;
use yii\helpers\ArrayHelper;
use yii\helpers\Utils;

/* @var $this yii\web\View */
/* @var $model backend\models\Pembelian */

$this->title = 'Detail Data Pembelian : ' . $model->kode_pembelian;
\yii\web\YiiAsset::register($this);
?>
<div class="pembelian-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><?= Html::a('Data Pembelian', ['index']) ?></li>
        <li class="active"><?= $this->title ?></li>
    </ul>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Hapus', ['delete', 'id' => $model->id_pembelian], [
                        'class' => 'btn btn-danger btn-hapus-hidden',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
    </p>

    <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-copy"></span> <?= $this->title ?></div>
            <div class="panel-body">
                <div class="col-md-12" style="padding: 0;">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        // 'id_pembelian',
                                        'kode_pembelian',
                                        [
                                            'attribute' => 'tanggal_pembelian',
                                            'label' => 'Tanggal Pembelian',
                                            'value' => function ($model) {
                                                if (!empty($model->tanggal_pembelian)) {
                                                    # code...
                                                    return tanggal_indo($model->tanggal_pembelian, true);
                                                } else {
                                                    # code...
                                                }
                                            }
                                        ],
                                        [
                                            'attribute' => 'id_perusahaan',
                                            'label' => 'Perusahaan',
                                            'value' => function ($model) {
                                                if (!empty($model->perusahaan->nama_perusahaan)) {
                                                    # code...
                                                    return $model->perusahaan->nama_perusahaan;
                                                } else {
                                                    # code...
                                                }
                                            }
                                        ],
                                    ],
                                ]) ?>
                            </div>
                        </div>
                        <div class="" style="margin-top:20px;">
                            <ul class="nav nav-tabs" id="tabForRefreshPage">
                                <li class="active"><a data-toggle="tab" class="link-tab" href="#data-barang"><span class="fa fa-box"></span> Data Barang Pembelian</a></li>
                            </ul>
                            <div class="tab-content">

                                <div id="data-barang" class="tab-pane fade in active" style="margin-top:20px;">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom:20px;">
                                            <?= Html::beginForm(['pembelian-detail/create', 'id' => $model->id_pembelian], 'post') ?>
                                            <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> Tambahkan Barang', ['class' => 'btn btn-success btn-lg btn-block']) ?>
                                            <?= Html::endForm() ?>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%;">#</th>
                                                        <th style="width: 10%;">Kode Barang</th>
                                                        <th style="width: 30%;">Nama Barang</th>
                                                        <th style="width: 10%;">Qty</th>
                                                        <th style="width: 8%;">Harga</th>
                                                        <th style="width: 10%;">Sub Total</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 1;
                                                        $total_akhir = 0;
                                                        $daftar_barang = Yii::$app->db->createCommand("SELECT pembelian_detail.*, barang.id_barang, barang.kode_barang, barang.nama_barang, pembelian_detail.qty, pembelian_detail.harga, pembelian_detail.id_pembelian_detail
                                                            FROM pembelian_detail 
                                                            LEFT JOIN barang ON barang.id_barang = pembelian_detail.id_barang
                                                            WHERE pembelian_detail.id_pembelian = $model->id_pembelian")->query();

                                                        foreach ($daftar_barang as $p) {

                                                            $total_harga = $p['qty'] * $p['harga'];
                                                            
                                                            $total_akhir += $total_harga;
                                                            // echo 'IDR '.ribuan($total_harga);
                                                    ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $p['kode_barang'] ?></td>
                                                        <td><?= $p['nama_barang'] ?></td>
                                                        <td><?= $p['qty'] ?></td>
                                                        <td><?= ribuan($p['harga']) ?></td>
                                                        <td><?= ribuan($p['qty']*$p['harga']) ?></td>
                                                        <td>
                                                            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['pembelian-detail/delete', 'id' => $p['id_pembelian_detail'], 'id_pembelian' => $model->id_pembelian], [
                                                                'class' => 'btn btn-danger',
                                                                'data' => [
                                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                                    'method' => 'post',
                                                                ],
                                                            ]) ?>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>

                                                    <tr>
                                                        <th colspan="5">TOTAL PEMBELIAN</th>
                                                        <td><?= ribuan($total_akhir); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

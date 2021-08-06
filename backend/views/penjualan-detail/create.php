<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PenjualanDetail */

$this->title = 'Tambahkan Penjualan Barang';
?>
<div class="penjualan-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data_barang' => $data_barang,
    ]) ?>

</div>

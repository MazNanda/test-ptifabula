<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PembelianDetail */

$this->title = 'Tambahkan Pembelian Barang';
?>
<div class="pembelian-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data_barang' => $data_barang,
    ]) ?>

</div>

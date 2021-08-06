<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Barang */

$this->title = 'Ubah Daftar Barang: ' . $model->kode_barang;
?>
<div class="barang-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><?= Html::a('Daftar Barang', ['index']) ?></li>
        <li class="active"><?= $this->title ?></li>
    </ul>

    <?= $this->render('_form', [
        'model' => $model,
        'nomor' => $nomor,
    ]) ?>

</div>

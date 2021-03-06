<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pembelian */

$this->title = 'Data Pembelian';
?>
<div class="pembelian-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><?= Html::a('Daftar Pembelian', ['pembelian/index']) ?></li>
        <li class="active">Tambah Data Pembelian </li>
    </ul>

    <?= $this->render('_form', [
        'model' => $model,
        'data_perusahaan' => $data_perusahaan,
    ]) ?>

</div>

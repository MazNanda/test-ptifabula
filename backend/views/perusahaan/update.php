<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Perusahaan */

$this->title = 'Ubah Daftar Perusahaan: ' . $model->kode_perusahaan;
?>
<div class="perusahaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><?= Html::a('Daftar Perusahaan', ['index']) ?></li>
        <li class="active"><?= $this->title ?></li>
    </ul>

    <?= $this->render('_form', [
        'model' => $model,
        'nomor' => $nomor,
    ]) ?>

</div>

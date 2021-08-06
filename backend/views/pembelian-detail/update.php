<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PembelianDetail */

$this->title = 'Update Pembelian Detail: ' . $model->id_pembelian_detail;
$this->params['breadcrumbs'][] = ['label' => 'Pembelian Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pembelian_detail, 'url' => ['view', 'id' => $model->id_pembelian_detail]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pembelian-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PenjualanDetail */

$this->title = 'Update Penjualan Detail: ' . $model->id_penjualan_detail;
$this->params['breadcrumbs'][] = ['label' => 'Penjualan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_penjualan_detail, 'url' => ['view', 'id' => $model->id_penjualan_detail]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penjualan-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Penjualan */

$this->title = 'Update Penjualan: ' . $model->id_penjualan;
$this->params['breadcrumbs'][] = ['label' => 'Penjualans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_penjualan, 'url' => ['view', 'id' => $model->id_penjualan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penjualan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

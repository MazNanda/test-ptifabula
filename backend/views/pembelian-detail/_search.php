<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PembelianDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pembelian_detail') ?>

    <?= $form->field($model, 'id_pembelian') ?>

    <?= $form->field($model, 'id_barang') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'harga') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

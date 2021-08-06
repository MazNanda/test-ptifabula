<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Perusahaan */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .btn-loading {
        background-color: #a0aec0;
        border: none;
        cursor: not-allowed;
    }

    .btn-loading:hover {
        background-color: #a0aec0;
    }

    .form-tipe.submitted input:invalid {
        border-bottom: 1px solid red;
    }

    .form-tipe.submitted input:valid {
        border-bottom: 1px solid green;
    }
</style>

<div class="perusahaan-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><span class="fa fa-box"></span> Barang</div>
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'kode_perusahaan')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $nomor]) ?>
                            <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true]) ?>
                            <div class="form-group">
                                <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                                <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> Simpan', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    <div class="col-lg-6">
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

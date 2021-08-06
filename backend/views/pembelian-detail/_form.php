<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\PembelianDetail */
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

<div class="pembelian-detail-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><span class="fa fa-box"></span> Barang</div>
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'id_pembelian')->HiddenInput()->label(false) ?>

                            <?= $form->field($model, 'id_barang')->widget(Select2::classname(), [
                                'data' => $data_barang,
                                'language' => 'en',
                                'options' => ['placeholder' => 'Pilih Barang'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Nama Barang')
                            ?>

                            <?= $form->field($model, 'qty')->textInput() ?>

                            <?= $form->field($model, 'harga')->widget(
                                \yii\widgets\MaskedInput::className(),
                                [
                                    'options' => ['autocomplete' => 'off'],
                                    'clientOptions' => ['alias' => 'decimal', 'groupSeparator' => '.', 'autoGroup' => true, 'removeMaskOnSubmit' => true, 'rightAlign' => false]
                                ]
                            ); ?>

                            <div class="form-group">
                                <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali', ['pembelian/view', 'id' => $model->id_pembelian], ['class' => 'btn btn-warning']) ?>
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

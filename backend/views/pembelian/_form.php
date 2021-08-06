<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\Pjax;

use backend\models\Perusahaan;

/* @var $this yii\web\View */
/* @var $model backend\models\Pembelian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembelian-form">
    <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Data Pembelian</div>
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= $form->field($model, 'kode_pembelian')->textInput(['readonly' => true]) ?>
                            </div>
                            <div class="form-group">
                                <?php

                                if ($model->tanggal_pembelian == '0000-00-00' || $model->tanggal_pembelian == '') {
                                    $model->tanggal_pembelian = Yii::$app->formatter->asDate('now', 'php:Y-m-d');
                                }

                                ?>

                                <?= $form->field($model, 'tanggal_pembelian')->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => 'Input Tanggal ...'],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                                ]); ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'id_perusahaan')->widget(Select2::classname(), [
                                    'data' => $data_perusahaan,
                                    'language' => 'en',
                                    'options' => ['placeholder' => 'Pilih Perusahaan'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ])->label('Perusahaan')
                                ?>
                            </div>
                            <div class="form-group">
                                <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                                <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-saved"></span> Simpan', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>


                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
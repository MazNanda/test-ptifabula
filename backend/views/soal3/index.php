<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Barang */

$this->title = 'Soal 2';
?>
<div class="barang-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <ul class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><?= Html::a('Soal 2') ?></li>
        <li class="active">Buatlah tampilan terbilang dari variable x yang berupa 4 digit angka ( lebih besar dari 2000 ) </li>
    </ul>
</div>
<div class="panel panel-primary">
    <div class="panel-heading"></div>
        <div class="panel-body">
            <div class="col-md-12" style="padding: 0;">
                <div class="box-body">
                    <?= Html::beginForm(['', array('class' => 'form-inline')]) ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Input Nominal</label>
                                  <input type="text" class="form-control" name="jumlah" placeholder="Input Nominal" value="<?= $jumlah ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> Hasil', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    <div class="col-lg-6">
                </div>
            </div>
        </div>
        <div class="panel-footer">
            Buatlah tampilan terbilang dari variablee <?= ribuan($jumlah) ?><br>
            <br/>
            <span style="max-width:150px;"> <b><i><?= terbilang(ceil($jumlah)) ?></i></b> </span>
        </div>
    </div>
</div>

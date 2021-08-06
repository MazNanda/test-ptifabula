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
        <li class="active">Buatlah tampilan berikut sesuai variable x </li>
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
                                  <label for="exampleFormControlInput1" class="form-label">Input Jumlah</label>
                                  <input type="text" class="form-control" name="jumlah" placeholder="Input Jumlah" value="<?= $jumlah ?>">
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
            Buatlah tampilan berikut sesuai variable <?= $jumlah ?><br>
            <?php
                for($a=$jumlah;$a>0;$a--){
                for($b=$jumlah;$b>=$a;$b--){
                    echo "*";
                }
                echo "<br>";
                }
            ?>
        </div>
    </div>
</div>

<?php

use backend\assets\AppAsset;
use backend\models\Foto;
use backend\models\Pengaturan;
use yii\helpers\Html;
use common\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
        .login-page {
            background-repeat: no-repeat;
            background-size: cover;
            <?php
            $pengaturan = Pengaturan::find()->where(['nama_pengaturan' => "Background Login"])->one();
            if (!empty($pengaturan) && $pengaturan->status == 1) {
                # code...
                $foto = Foto::find()->where(['nama_tabel' => 'pengaturan', 'id_tabel' => 3])->one();
                if (!empty($foto)) {
                    echo "background-image: url('upload/$foto->foto')";
                } else {
                    echo "background-image: url('images/aaa.jpg');";
                }
            } else {
                echo "background-image: url('images/aaa.jpg');";
            }
            ?>
        }
    </style>
</head>

<body class="login-page">

    <?= Alert::widget() ?>

    <?php $this->beginBody() ?>

    <?= $content ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
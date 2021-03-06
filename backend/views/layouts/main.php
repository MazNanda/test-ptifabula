<?php

use backend\models\Login;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->user->isGuest) {

    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(Yii::$app->name) ?></title>
        <!-- DataTables -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"> -->
        <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <?php $this->head() ?>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <!-- Smartsupp Live Chat script -->
        <!-- <script type="text/javascript">
            var _smartsupp = _smartsupp || {};
            _smartsupp.key = 'b4aa6006bdaf3367b40638d21cdd8ae2281acfab';
            window.smartsupp || (function(d) {
                var s, c, o = smartsupp = function() {
                    o._.push(arguments)
                };
                o._ = [];
                s = d.getElementsByTagName('script')[0];
                c = d.createElement('script');
                c.type = 'text/javascript';
                c.charset = 'utf-8';
                c.async = true;
                c.src = 'https://www.smartsuppchat.com/loader.js?';
                s.parentNode.insertBefore(c, s);
            })(document);
        </script> -->

        <style>
            .btn-loading {
                background-color: #a0aec0;
                border: none;
                cursor: not-allowed;
            }

            .btn-loading:hover {
                background-color: #a0aec0;
            }
        </style>
    </head>

    <body class="hold-transition skin-yellow sidebar-mini fixed">
        <?php $this->beginBody() ?>
        <div class="outer-loader hidden">
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="wrapper">

            <?= $this->render(
                'header.php',
                ['directoryAsset' => $directoryAsset]
            ) ?>

            <?= $this->render(
                'left.php',
                ['directoryAsset' => $directoryAsset]
            )
            ?>

            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            )
            ?>

            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; <?= date('Y') ?> <a href="http://gss-accounting.com">Hernanda Eka Putra</a>.</strong> All rights
                reserved.
            </footer>

            <?php
            yii\bootstrap\Modal::begin([
                'headerOptions' => ['id' => 'modalHeader'],
                'options' => ['tabindex' => false],
                'id' => 'modal',
                'size' => 'modal-md',
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
            ]);
            echo "<div id='modalContent'></div>";
            yii\bootstrap\Modal::end();
            ?>

        </div>

        <?php $this->endBody() ?>
    </body>
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $('#tabForRefreshPage li a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#tabForRefreshPage li a[href="' + hash + '"]').tab('show');

        const approver = document.querySelector('.btn-approver-hidden');
        const formUser = document.querySelector('.form-user');
        const btnUbah = document.querySelector('.btn-ubah-hidden');
        const btnHapus = document.querySelector('.btn-hapus-hidden');
        const btnPending = document.querySelector('.btn-pending-hidden');
        const btnHapusDetail = document.querySelector('.btn-hapus-detail');
        const btnUbahDetail = document.querySelector('.btn-ubah-detail');
        if (approver != null) {
            formUser.style.display = "none";
            btnPending.style.display = "none";
            btnHapusDetail.style.display = "none"
            btnUbahDetail.style.display = "none"
        } else {
            btnHapusDetail.style.display = true
            btnUbahDetail.style.display = true
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#table-index').DataTable();
            $('.datatables').DataTable();
            $('#pagination').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        });

        $(document).ready(function() {
            function disabled() {
                $(".outer-loader").removeClass("hidden");
            }

            function not_disabled() {
                $(".outer-loader").addClass("hidden");
            }


            $('form').submit(function(e) {
                var $form = $(this);
                data = $form.data('yiiActiveForm');
                console.log(data.validated);
                if (data.validated) {
                    disabled();
                } else {
                    not_disabled();
                }
            })
            // $('form').submit(function(e) {
            //     $(".outer-loader").removeClass("hidden");
            //     setTimeout(function() {
            //         $(".outer-loader").addClass("hidden");
            //         return false;
            //     }, 3000);
            // });

            $('a').click(function() {
                $(".outer-loader").removeClass("hidden");
                setTimeout(function() {
                    $(".outer-loader").addClass("hidden");
                    return false;
                }, 500);
            })
        });
    </script>

    </html>
    <?php $this->endPage() ?>
<?php } ?>
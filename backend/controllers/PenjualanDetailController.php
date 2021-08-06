<?php

namespace backend\controllers;

use Yii;
use backend\models\PenjualanDetail;
use backend\models\PenjualanDetailSearch;
use backend\models\Penjualan;
use backend\models\Barang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenjualanDetailController implements the CRUD actions for PenjualanDetail model.
 */
class PenjualanDetailController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PenjualanDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenjualanDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenjualanDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PenjualanDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PenjualanDetail();
        $id_transaksi_penjualan = $_GET['id'];
        $model->id_penjualan = $id_transaksi_penjualan;

        $data_barang = PenjualanDetail::dataBarang();

        if ($model->load(Yii::$app->request->post())) {
            
            $update_stok = Barang::find()->WHERE(['id_barang' => $model->id_barang])->one();
            
            // echo $update_stok->stok;
            // echo $model->qty;
            // exit();
            
            if ($model->qty > $update_stok->stok) {
                // code...
                Yii::$app->session->setFlash('warning', [['Gagal!', '
                    <p>Stok anda kurang.</p>
                ']]);
            } else {
                $model->save();
                $update_stok->stok = $update_stok->stok - $model->qty;
                $update_stok->save(false);
            }
            
            return $this->redirect(['penjualan/view', 'id' => $id_transaksi_penjualan]);
        }

        return $this->render('create', [
            'model' => $model,
            'data_barang' => $data_barang,
        ]);
    }

    /**
     * Updates an existing PenjualanDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_penjualan_detail]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PenjualanDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $id_penjualan)
    {
        $penjualan_detail = PenjualanDetail::find()->WHERE(['id_penjualan_detail' => $id])->one();
        $update_stok = Barang::find()->WHERE(['id_barang' => $penjualan_detail->id_barang])->one();
        $update_stok->stok = $update_stok->stok + $penjualan_detail->qty;
        $update_stok->save(false);

        $this->findModel($id)->delete();

        return $this->redirect(['penjualan/view', 'id' => $id_penjualan]);
    }

    /**
     * Finds the PenjualanDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenjualanDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenjualanDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

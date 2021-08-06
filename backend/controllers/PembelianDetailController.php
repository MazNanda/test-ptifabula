<?php

namespace backend\controllers;

use Yii;
use backend\models\PembelianDetail;
use backend\models\PembelianDetailSearch;
use backend\models\Pembelian;
use backend\models\Barang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PembelianDetailController implements the CRUD actions for PembelianDetail model.
 */
class PembelianDetailController extends Controller
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
     * Lists all PembelianDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembelianDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PembelianDetail model.
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
     * Creates a new PembelianDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PembelianDetail();
        $id_transaksi_pembelian = $_GET['id'];
        $model->id_pembelian = $id_transaksi_pembelian;

        $data_barang = PembelianDetail::dataBarang();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();

            $update_stok = Barang::find()->WHERE(['id_barang' => $model->id_barang])->one();
            $update_stok->stok = $update_stok->stok + $model->qty;
            $update_stok->save(false);

            return $this->redirect(['pembelian/view', 'id' => $id_transaksi_pembelian]);
        }

        return $this->render('create', [
            'model' => $model,
            'data_barang' => $data_barang,
        ]);
    }

    /**
     * Updates an existing PembelianDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pembelian_detail]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PembelianDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $id_pembelian)
    {
        $pembelian_detail = PembelianDetail::find()->WHERE(['id_pembelian_detail' => $id])->one();
        $update_stok = Barang::find()->WHERE(['id_barang' => $pembelian_detail->id_barang])->one();
        $update_stok->stok = $update_stok->stok - $pembelian_detail->qty;
        $update_stok->save(false);

        $this->findModel($id)->delete();

        return $this->redirect(['pembelian/view', 'id' => $id_pembelian]);
    }

    /**
     * Finds the PembelianDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembelianDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembelianDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

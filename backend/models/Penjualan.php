<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "penjualan".
 *
 * @property int $id_penjualan
 * @property string $kode_penjualan
 * @property string $tanggal_penjualan
 * @property int $id_perusahaan
 * @property double $total
 */
class Penjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_penjualan', 'tanggal_penjualan', 'id_perusahaan'], 'required'],
            [['tanggal_penjualan'], 'safe'],
            [['id_perusahaan'], 'integer'],
            [['kode_penjualan'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_penjualan' => 'Id Penjualan',
            'kode_penjualan' => 'Kode Penjualan',
            'tanggal_penjualan' => 'Tanggal Penjualan',
            'id_perusahaan' => 'Perusahaan',
        ];
    }

    public function getperusahaan()
    {
        return $this->hasOne(Perusahaan::className(), ['id_perusahaan' => 'id_perusahaan']);
    }

    public static function dataPerusahaan()
    {

        $data_perusahaan = ArrayHelper::map(
            Perusahaan::find()
                ->all(),
            'id_perusahaan',
            function ($model) {
                return $model['kode_perusahaan'] . ' - ' . $model['nama_perusahaan'];
            }
        );

        return $data_perusahaan;
    }
}

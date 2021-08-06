<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pembelian".
 *
 * @property int $id_pembelian
 * @property string $kode_pembelian
 * @property string $tanggal_pembelian
 * @property int $id_perusahaan
 * @property double $total
 */
class Pembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_pembelian', 'tanggal_pembelian', 'id_perusahaan'], 'required'],
            [['tanggal_pembelian'], 'safe'],
            [['id_perusahaan'], 'integer'],
            [['kode_pembelian'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pembelian' => 'Id Pembelian',
            'kode_pembelian' => 'Kode Pembelian',
            'tanggal_pembelian' => 'Tanggal Pembelian',
            'id_perusahaan' => 'Nama Perusahaan',
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

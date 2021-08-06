<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "penjualan_detail".
 *
 * @property int $id_penjualan_detail
 * @property int $id_penjualan
 * @property int $id_barang
 * @property int $qty
 * @property double $harga
 */
class PenjualanDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penjualan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_penjualan', 'id_barang', 'qty', 'harga'], 'required'],
            [['id_penjualan', 'id_barang', 'qty'], 'integer'],
            [['harga'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_penjualan_detail' => 'Id Penjualan Detail',
            'id_penjualan' => 'Id Penjualan',
            'id_barang' => 'Id Barang',
            'qty' => 'Qty',
            'harga' => 'Harga',
        ];
    }

    public function getbarang()
    {
        return $this->hasOne(Barang::className(), ['id_barang' => 'id_barang']);
    }

    public static function dataBarang()
    {

        $data_barang = ArrayHelper::map(
            Barang::find()
                ->all(),
            'id_barang',
            function ($model) {
                return $model['kode_barang'] . ' - ' . $model['nama_barang'] . ' - Stok: ' . $model['stok'];
            }
        );

        return $data_barang;
    }
}

<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pembelian_detail".
 *
 * @property int $id_pembelian_detail
 * @property int $id_pembelian
 * @property int $id_barang
 * @property int $qty
 * @property double $harga
 */
class PembelianDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembelian_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pembelian', 'id_barang', 'qty', 'harga'], 'required'],
            [['id_pembelian', 'id_barang', 'qty'], 'integer'],
            [['harga'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pembelian_detail' => 'Id Pembelian Detail',
            'id_pembelian' => 'Id Pembelian',
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

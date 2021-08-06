<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property int $id_barang
 * @property string $kode_barang
 * @property string $nama_barang
 * @property double $harga
 * @property int $stok
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_barang', 'nama_barang', 'harga', 'stok'], 'required'],
            [['harga'], 'number'],
            [['stok'], 'integer'],
            [['kode_barang', 'nama_barang'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_barang' => 'Id Barang',
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'harga' => 'Harga',
            'stok' => 'Stok',
        ];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "perusahaan".
 *
 * @property int $id_perusahaan
 * @property string $kode_perusahaan
 * @property string $nama_perusahaan
 */
class Perusahaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perusahaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_perusahaan', 'nama_perusahaan'], 'required'],
            [['kode_perusahaan', 'nama_perusahaan'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_perusahaan' => 'Id Perusahaan',
            'kode_perusahaan' => 'Kode Perusahaan',
            'nama_perusahaan' => 'Nama Perusahaan',
        ];
    }
}

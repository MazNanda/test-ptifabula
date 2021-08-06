<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PembelianDetail;

/**
 * PembelianDetailSearch represents the model behind the search form of `backend\models\PembelianDetail`.
 */
class PembelianDetailSearch extends PembelianDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pembelian_detail', 'id_pembelian', 'id_barang', 'qty'], 'integer'],
            [['harga'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PembelianDetail::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pembelian_detail' => $this->id_pembelian_detail,
            'id_pembelian' => $this->id_pembelian,
            'id_barang' => $this->id_barang,
            'qty' => $this->qty,
            'harga' => $this->harga,
        ]);

        return $dataProvider;
    }
}

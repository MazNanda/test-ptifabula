<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PenjualanDetail;

/**
 * PenjualanDetailSearch represents the model behind the search form of `backend\models\PenjualanDetail`.
 */
class PenjualanDetailSearch extends PenjualanDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_penjualan_detail', 'id_penjualan', 'id_barang', 'qty'], 'integer'],
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
        $query = PenjualanDetail::find();

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
            'id_penjualan_detail' => $this->id_penjualan_detail,
            'id_penjualan' => $this->id_penjualan,
            'id_barang' => $this->id_barang,
            'qty' => $this->qty,
            'harga' => $this->harga,
        ]);

        return $dataProvider;
    }
}

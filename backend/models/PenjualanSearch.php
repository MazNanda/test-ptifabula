<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Penjualan;

/**
 * PenjualanSearch represents the model behind the search form of `backend\models\Penjualan`.
 */
class PenjualanSearch extends Penjualan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_penjualan', 'id_perusahaan'], 'integer'],
            [['kode_penjualan', 'tanggal_penjualan'], 'safe'],
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
        $query = Penjualan::find();

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
            'id_penjualan' => $this->id_penjualan,
            'tanggal_penjualan' => $this->tanggal_penjualan,
            'id_perusahaan' => $this->id_perusahaan,
        ]);

        $query->andFilterWhere(['like', 'kode_penjualan', $this->kode_penjualan]);

        return $dataProvider;
    }
}

<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pembelian;

/**
 * PembelianSearch represents the model behind the search form of `backend\models\Pembelian`.
 */
class PembelianSearch extends Pembelian
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pembelian', 'id_perusahaan'], 'integer'],
            [['kode_pembelian', 'tanggal_pembelian'], 'safe'],
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
        $query = Pembelian::find();

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
            'id_pembelian' => $this->id_pembelian,
            'tanggal_pembelian' => $this->tanggal_pembelian,
            'id_perusahaan' => $this->id_perusahaan,
        ]);

        $query->andFilterWhere(['like', 'kode_pembelian', $this->kode_pembelian]);

        return $dataProvider;
    }
}

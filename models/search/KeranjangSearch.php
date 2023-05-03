<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Keranjang;

/**
 * KeranjangSearch represents the model behind the search form about `app\models\Keranjang`.
 */
class KeranjangSearch extends Keranjang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'produk_id', 'user_id', 'jumlah'], 'integer'],
            [['harga'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Keranjang::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'produk_id' => $this->produk_id,
            'user_id' => $this->user_id,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'harga', $this->harga]);

        return $dataProvider;
    }
}

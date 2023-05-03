<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReviewProduk;

/**
* ReviewProdukSearch represents the model behind the search form about `app\models\ReviewProduk`.
*/
class ReviewProdukSearch extends ReviewProduk
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'produk_id', 'rating'], 'integer'],
            [['nama', 'email', 'review', 'created_at'], 'safe'],
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
$query = ReviewProduk::find();

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
            'rating' => $this->rating,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'review', $this->review]);

return $dataProvider;
}
}
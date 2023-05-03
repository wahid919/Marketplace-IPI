<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FotoProduk;

/**
* FotoProdukSearch represents the model behind the search form about `app\models\FotoProduk`.
*/
class FotoProdukSearch extends FotoProduk
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'produk_id', 'flag'], 'integer'],
            [['foto'], 'safe'],
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
$query = FotoProduk::find();

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
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'foto', $this->foto]);

return $dataProvider;
}
}
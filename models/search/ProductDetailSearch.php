<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductDetail;

/**
* ProductDetailSearch represents the model behind the search form about `app\models\ProductDetail`.
*/
class ProductDetailSearch extends ProductDetail
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'id_product', 'stok', 'id_variant'], 'integer'],
            [['color', 'size'], 'safe'],
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
$query = ProductDetail::find();

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
            'id_product' => $this->id_product,
            'stok' => $this->stok,
            'id_variant' => $this->id_variant,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'size', $this->size]);

return $dataProvider;
}
}
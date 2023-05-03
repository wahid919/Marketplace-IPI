<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HubungiKami;

/**
* HubungiKamiSearch represents the model behind the search form about `app\models\HubungiKami`.
*/
class HubungiKamiSearch extends HubungiKami
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'tema_hubungi_kami_id', 'status'], 'integer'],
            [['nama', 'nomor_hp', 'created_at', 'updated_at'], 'safe'],
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
$query = HubungiKami::find();

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
            'tema_hubungi_kami_id' => $this->tema_hubungi_kami_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nomor_hp', $this->nomor_hp]);

return $dataProvider;
}
}
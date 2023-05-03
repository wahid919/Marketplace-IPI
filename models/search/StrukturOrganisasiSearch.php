<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StrukturOrganisasi;

/**
* StrukturOrganisasiSearch represents the model behind the search form about `app\models\StrukturOrganisasi`.
*/
class StrukturOrganisasiSearch extends StrukturOrganisasi
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'flag'], 'integer'],
            [['nama', 'jabatan', 'foto'], 'safe'],
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
$query = StrukturOrganisasi::find();

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
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'foto', $this->foto]);

return $dataProvider;
}
}
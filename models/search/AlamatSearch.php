<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alamat;

/**
* AlamatSearch represents the model behind the search form about `app\models\Alamat`.
*/
class AlamatSearch extends Alamat
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'usrid', 'status', 'idkec'], 'integer'],
            [['judul', 'alamat', 'kodepos', 'nama', 'nohp'], 'safe'],
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
$query = Alamat::find();

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
            'usrid' => $this->usrid,
            'status' => $this->status,
            'idkec' => $this->idkec,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kodepos', $this->kodepos])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nohp', $this->nohp]);

return $dataProvider;
}
}
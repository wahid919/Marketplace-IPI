<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Member;

/**
* MemberSearch represents the model behind the search form about `app\models\Member`.
*/
class MemberSearch extends Member
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'handphone', 'flag'], 'integer'],
            [['nama', 'email', 'alamat', 'cabang_olahraga', 'komunitas_olahraga'], 'safe'],
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
$query = Member::find();

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
            'handphone' => $this->handphone,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'cabang_olahraga', $this->cabang_olahraga])
            ->andFilterWhere(['like', 'komunitas_olahraga', $this->komunitas_olahraga]);

return $dataProvider;
}
}
<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Toko;

/**
* TokoSearch represents the model behind the search form about `app\models\Toko`.
*/
class TokoSearch extends Toko
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'id_user', 'flag'], 'integer'],
            [['nama', 'deskripsi', 'alamat', 'no_whatsapp', 'created_at', 'updated_at'], 'safe'],
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
$query = Toko::find();

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
            'id_user' => $this->id_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'flag' => $this->flag,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_whatsapp', $this->no_whatsapp]);

return $dataProvider;
}
}
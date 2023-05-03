<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Setting;

/**
* SettingSearch represents the model behind the search form about `app\models\Setting`.
*/
class SettingSearch extends Setting
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id'], 'integer'],
            [['logo', 'judul_web', 'tentang_kami', 'judul_tentang_kami', 'foto_tentang_kami', 'foto_member', 'facebook', 'instagram', 'telepon', 'email', 'twitter', 'telegram', 'nama_web', 'alamat', 'visi', 'misi', 'slogan_web', 'banner'], 'safe'],
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
$query = Setting::find();

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
        ]);

        $query->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'judul_web', $this->judul_web])
            ->andFilterWhere(['like', 'tentang_kami', $this->tentang_kami])
            ->andFilterWhere(['like', 'judul_tentang_kami', $this->judul_tentang_kami])
            ->andFilterWhere(['like', 'foto_tentang_kami', $this->foto_tentang_kami])
            ->andFilterWhere(['like', 'foto_member', $this->foto_member])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'telepon', $this->telepon])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'nama_web', $this->nama_web])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'visi', $this->visi])
            ->andFilterWhere(['like', 'misi', $this->misi])
            ->andFilterWhere(['like', 'slogan_web', $this->slogan_web])
            ->andFilterWhere(['like', 'banner', $this->banner]);

return $dataProvider;
}
}
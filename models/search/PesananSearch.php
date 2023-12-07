<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetailPesanan;
use app\models\Toko;

/**
 * PesananSearch represents the model behind the search form about `app\models\DetailPesanan`.
 */
class PesananSearch extends DetailPesanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'invoice', 'nominal', 'usrid', 'status_id'], 'integer'],
            [['nama', 'created_at', 'updated_at'], 'safe'],
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
        $query = DetailPesanan::find();

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
            'invoice' => $this->invoice,
            'nominal' => $this->nominal,
            'usrid' => $this->usrid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
    public function searchAdmin($params, $activeTab)
    {
        $tokoId = Toko::find()->select('id')->where(['id_user' => Yii::$app->user->identity->id])->one();

        $query = (new \yii\db\Query())
            ->select('detail_pesanan.*')
            ->from('detail_pesanan')
            ->join('JOIN', 'toko', 'detail_pesanan.toko_id = toko.id')
            ->where(['detail_pesanan.toko_id' => $tokoId->id]);

        if ($activeTab === 'belum-bayar') {
            $query->andWhere(['status_id' => 3]);
        } elseif ($activeTab === 'perlu-dikirim') {
            $query->andWhere(['status_id' => 2]);
        } elseif ($activeTab === 'sedang-dikirim') {
            $query->andWhere(['status_id' => 10]);
        } elseif ($activeTab === 'selesai') {
            $query->andWhere(['status_id' => 11]);
        } elseif ($activeTab === 'dibatalkan') {
            $query->andWhere(['or', ['status_id' => 5], ['status_id' => 4], ['status_id' => 6]]);
        }

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
            'invoice' => $this->invoice,
            'nominal' => $this->nominal,
            'usrid' => $this->usrid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);
        $detailPesanan = $query->all();
        $dataProvider->setModels($detailPesanan);

        return $dataProvider;
    }
}

<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Produk;

/**
 * ProdukSearch represents the model behind the search form about `app\models\Produk`.
 */
class ProdukSearch extends Produk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'harga', 'stok', 'kategori_produk_id', 'toko_id', 'status_online', 'flag', 'diskon_status', 'diskon'], 'integer'],
            [['nama', 'deskripsi_singkat', 'deksripsi_lengkap', 'foto_banner', 'created_at'], 'safe'],
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
        $query = Produk::find();

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
            'harga' => $this->harga,
            'stok' => $this->stok,
            'kategori_produk_id' => $this->kategori_produk_id,
            'toko_id' => $this->toko_id,
            'status_online' => $this->status_online,
            'flag' => $this->flag,
            'created_at' => $this->created_at,
            'diskon_status' => $this->diskon_status,
            'diskon' => $this->diskon,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'deskripsi_singkat', $this->deskripsi_singkat])
            ->andFilterWhere(['like', 'deksripsi_lengkap', $this->deksripsi_lengkap])
            ->andFilterWhere(['like', 'foto_banner', $this->foto_banner]);

        return $dataProvider;
    }
}
<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Vehicle;
use common\components\SystemConstant;

/**
 * VehicleSearch represents the model behind the search form of `backend\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'image_id', 'manufacturer', 'color', 'original_price', 'selling_price', 'total_quantity', 'status'], 'integer'],
            [['SKU', 'name', 'image_related', 'model', 'series', 'engine_number', 'manufacture_date', 'note', 'created_at', 'updated_at'], 'safe'],
            [['fuel_capacity', 'discount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Vehicle::find()->where(['status' => SystemConstant::STATUS_ACTIVE]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'image_id' => $this->image_id,
            'manufacturer' => $this->manufacturer,
            'color' => $this->color,
            'fuel_capacity' => $this->fuel_capacity,
            'original_price' => $this->original_price,
            'selling_price' => $this->selling_price,
            'discount' => $this->discount,
            'total_quantity' => $this->total_quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'SKU', $this->SKU])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image_related', $this->image_related])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'series', $this->series])
            ->andFilterWhere(['like', 'engine_number', $this->engine_number])
            ->andFilterWhere(['like', 'manufacture_date', $this->manufacture_date])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}

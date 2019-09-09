<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Showcase;

/**
 * ShowcaseSearch represents the model behind the search form of `common\models\Showcase`.
 */
class ShowcaseSearch extends Showcase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'technique_id', 'course_id', 'showcase_type_id'], 'integer'],
            [['date_published', 'main_photo'], 'safe'],
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
        $query = Showcase::find();

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
            'technique_id' => $this->technique_id,
            'course_id' => $this->course_id,
            'showcase_type_id' => $this->showcase_type_id,
            'date_published' => $this->date_published,
        ]);

        $query->andFilterWhere(['like', 'main_photo', $this->main_photo]);

        return $dataProvider;
    }
}

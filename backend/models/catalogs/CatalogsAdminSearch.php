<?php

namespace backend\models\catalogs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\catalogs\CatalogsAdmin;

/**
 * CatalogsAdminSearch represents the model behind the search form about `app\modules\admin\models\CatalogsAdmin`.
 */
class CatalogsAdminSearch extends CatalogsAdmin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'id_parent', 'expanded', 'root', 'lft', 'rgt', 'level'], 'integer'],
            [['name'], 'safe'],
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
        $query = CatalogsAdmin::find()->where(['not', ['name'=>'ROOT']]);

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
            'catalog_id' => $this->catalog_id,
            'id_parent' => $this->id_parent,
            'expanded' => $this->expanded,
            'root' => $this->root,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

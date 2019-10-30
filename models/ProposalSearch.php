<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proposal;

/**
 * ProposalSearch represents the model behind the search form about `\app\models\Proposal`.
 */
class ProposalSearch extends Proposal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'married_status', 'nation', 'religion', 'last_education'], 'integer'],
            [['name', 'birth_place', 'birth_date', 'address', 'ktp', 'major', 'univ_name', 'accreditation', 'ipk', 'phone', 'email', 'socmed', 'skill', 'experience', 'diploma_file', 'transcript_file', 'ktp_file', 'photo'], 'safe'],
            [['salary_expect'], 'number'],
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
        $query = Proposal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
		$dataProvider->setSort([
            'defaultOrder' => ['id' => SORT_DESC]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sex' => $this->sex,
            'married_status' => $this->married_status,
            'nation' => $this->nation,
            'religion' => $this->religion,
            'last_education' => $this->last_education,
            'salary_expect' => $this->salary_expect,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'birth_place', $this->birth_place])
            ->andFilterWhere(['like', 'birth_date', $this->birth_date])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'ktp', $this->ktp])
            ->andFilterWhere(['like', 'major', $this->major])
            ->andFilterWhere(['like', 'univ_name', $this->univ_name])
            ->andFilterWhere(['like', 'accreditation', $this->accreditation])
            ->andFilterWhere(['like', 'ipk', $this->ipk])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'socmed', $this->socmed])
            ->andFilterWhere(['like', 'skill', $this->skill])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'diploma_file', $this->diploma_file])
            ->andFilterWhere(['like', 'transcript_file', $this->transcript_file])
            ->andFilterWhere(['like', 'ktp_file', $this->ktp_file])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}

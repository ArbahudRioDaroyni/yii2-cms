<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `\app\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'publish', 'created_by', 'updated_by'], 'integer'],
            [['title', 'link', 'excerpt', 'content', 'featured_image', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params, $limit=null)
    {
        $query = Article::find()->orderBy(['id' => SORT_DESC]);
        
        if($limit>0){
            $query->limit($limit);
        }
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'publish' => $this->publish,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'excerpt', $this->excerpt])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'featured_image', $this->featured_image]);

		
        return $dataProvider;
    }
	
	/**
	 * Fungsi untuk mencari yang aktif
	 * @param array $params
	 */
	public function searchActive($params=[])
	{
		//Selalu cari yang aktif
		$params['ArticleSearch']['publish'] = Article::STATUS_PUBLISH;
		return $this->search($params);
	}
	
	public function searchKeyword($keyword)
	{
		$query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['publish'=>Article::STATUS_PUBLISH]);
			
		$query->andFilterWhere(['or',
            ['like','title',$keyword],
            ['like','content',$keyword],
            ['like','excerpt',$keyword]
		]);
				
		return $dataProvider;
	}
}

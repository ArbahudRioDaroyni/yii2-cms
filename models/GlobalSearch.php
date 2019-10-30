<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Doctor;
use app\models\Article;
use app\models\Page;

class GlobalSearch extends \yii\db\ActiveRecord
{
    const SEARCH_NUM = 6; //jumlah maksimal pencarian 
    
    public $globalSearch;
    public $filter = [];
    
    public function rules()
    {
        return [
            [['globalSearch'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $modelFilters = Filter::find()->all();
        
        $this->load($params);
        
        $search = $this->globalSearch;
        //Filter semua kata-kata agar hanya ada kata utama.
        foreach ($modelFilters as $key => $value) {
            $search = str_replace($value['name'], "", $search);
        }
        
        ///////////////////Mencari Dokter
        $queryDoctor = Doctor::find()->orderBy('name');

        $dataProviderDoctor = new ActiveDataProvider([
            'query' => $queryDoctor,
            'sort' => false,
            'pagination' => [
                'pageSize' => self::SEARCH_NUM
            ]
        ]);
        
        $queryDoctor->join('inner join', 'specialization', 'specialization.id=doctor.specialization_id');

        $queryDoctor->orFilterWhere(['like', 'doctor.name', $search])
        ->orFilterWhere(['like', 'description', $search])
        ->orFilterWhere(['like', 'tags', $search])
        ->orFilterWhere(['like','specialization.name', $search]);

        
        ///////////////////Mencari Artikel
        $queryArticle = Article::find()->orderBy('title');

        $dataProviderArticle = new ActiveDataProvider([
            'query' => $queryArticle,
            'sort' => false,
            'pagination' => [
                'pageSize' => self::SEARCH_NUM
            ]
        ]);

        $queryArticle->orFilterWhere(['like', 'title', $search])
        ->orFilterWhere(['like', 'content', $search])
        ->orFilterWhere(['like', 'tags', $search]);
        
        
        
        ///////////////////Mencari Page
        $queryPage = Page::find()->orderBy('title');

        $dataProviderPage = new ActiveDataProvider([
            'query' => $queryPage,
            'sort' => false,
            'pagination' => [
                'pageSize' => self::SEARCH_NUM
            ]
        ]);

        $queryPage->orFilterWhere(['like', 'title', $search])
        ->orFilterWhere(['like', 'content', $search])
        ->orFilterWhere(['like', 'tags', $search]);
        
        $data = [$dataProviderDoctor, $dataProviderArticle, $dataProviderPage];

        return $data;
    }
}

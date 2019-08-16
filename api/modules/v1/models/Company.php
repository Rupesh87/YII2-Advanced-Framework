<?php

namespace app\modules\v1\models;

use yii\behaviors\TimestampBehavior;

class Company extends \yii\mongodb\ActiveRecord
{

    const SCENARIO_CREATE = 'create';


//    public function beforeValidate()
//    {
//        if ($this->date)
//        {
//            $this->date = Yii::$app->formatter->asDate(strtotime($this->date), "php:Y-m-d");
//        }
//        return parent::beforeValidate();
//    }

    public static function collectionName()
    {
        return 'company';
    }

    /**
     * @return array list of attribute names to create properties for.
     */
    public function attributes()
    {
        return [
            '_id',
            'company_name',
            'description',
            'address',
            'date',
            'pan_no',
            'contact_no',
            'email',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),		// Auto timestamp created and updated properties
        ];
    }

    /**
     * Set rules for all properties that you want to set via the API endpoint
     * @return type
     */
    public function rules()
    {
        return [
            [['company_name', 'address','description'], 'string'],
            [['company_name', 'date','email'], 'required'],
            [['created_at','updated_at', 'pan_no'], 'integer'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['date', 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['_id','name','email'];
        return $scenarios;
    }

    /**
     * Describes which fields to return for queries against a Token(s)
     * @return array
     */
    public function fields()
    {
        return [
            '_id',
            'company_name',
            'description',
            'address',
            'date',
            'pan_no',
            'contact_no',
            'email',
            'created_at',
            'updated_at'
        ];
    }
}

<?php
namespace api\modules\v1\controllers;

use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use app\modules\v1\models\Company;

class CompanyController extends ActiveController
{

    public $modelClass = Company::class;

//    public $serializer = [
//        'class' => 'yii\rest\Serializer',
//        'collectionEnvelope' => 'company'
//    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);

        // add CORS filter before authentication
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }
}

<?php
namespace  api\modules\v1\controllers;

use frontend\models\SignupForm;
use Yii;
use yii\web\Controller;

class RegistrationController extends Controller
{
    public $modelClass = 'common\models\User';
    public function actionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $model = new SignupForm();
        $params = Yii::$app->request->post();
        $model->username = isset($params['username']) ? $params['username'] : '';
        $model->password = isset($params['password']) ? $params['password'] : '';
        $model->email = isset($params['email']) ? $params['email'] : '';
        $model->date_of_birth = isset($params['date_of_birth']) ? $params['date_of_birth'] : '';
        $model->profession = isset($params['profession']) ? $params['profession'] : '';
        $model->country = isset($params['country']) ? $params['country'] : '';
        $model->registration_date = isset($params['registration_date']) ? $params['registration_date'] : '';
        $model->name = isset($params['name']) ? $params['name'] : '';

        if ($model->signup()) {
            $response['isSuccess'] = 201;

            $response['message'] = 'Successfully sign up!';
            $response['user'] =\common\models\User::findByUsername($model->username);
            return $response;
        }
        else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            return $response;

        }
    }
}
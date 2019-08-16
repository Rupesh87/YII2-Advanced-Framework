<?php
namespace  api\modules\v1\controllers;

use common\models\LoginForm;
use Yii;
use yii\web\Controller;

class LoginController extends Controller
{
    public $modelClass = 'common\models\User';

    public function actionCreate(){
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $model = new LoginForm();
        $params = Yii::$app->request->post();
        $model->email = isset($params['email']) ? $params['email'] : '';
        $model->password = isset($params['password']) ? $params['password'] : '';
        if ($model->login()) {
            $response['user'] = \common\models\User::findByEmail($model->email);
            $response['Authorization'] = 'Bearer'. ' ' .$response['user']['auth_key'];
            $response['message'] = 'You are now logged in!';
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
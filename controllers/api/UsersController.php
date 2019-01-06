<?php

namespace kouosl\user\controllers\api;

use kouosl\user\models\User;
use kouosl\site\models\SignupForm;
use Yii;

class UsersController extends DefaultController {
	
	public $modelClass = 'kouosl\user\models\User';

	public function actions() {
		$actions = parent::actions ();
	
		return $actions;
	}
	
	public function actionView($id){

		$model = User::findOne($id);
		
		if(!$model)
			return ['status' => '404','message' => 'Not Found'];

		return $model;
	}
	
	public function actionIndex(){
		return User::find()->all();
	}
	
	public function actionCreate(){

        $postParams = json_decode(Yii::$app->request->getRawBody(), true);        
        $model = new SignupForm();

        if ($model->load($postParams,'') && $model->validate()) {
            if ($user = $model->signup()) {            
                return $user;
            }
        }else{
            return ['status' => 500];
        }
	}
	
	public function actionUpdate($id){

		$postParams = json_decode(Yii::$app->request->getRawBody(), true);
		
		$model = User::findOne($id);

		if($model = $this->LoadModel($model, $postParams)){
				if($model->save())
					return $model;
				else 
					return ['status' => 101,'message' => $model->errors];
		}else
		    return ['status' => 100];
	}
	
	public function actionDelete($id){
		
		if(User::findOne($id)->delete())
			return ['status' => 1];
		else
			return ['stauts' => 100];
	}
	
	public function LoadModel($model,$params)
	{
		foreach ($params as $key => $value)
			$model->hasAttribute($key) ? $model->$key = $value : " "; 
			
		return $model;
	}
}
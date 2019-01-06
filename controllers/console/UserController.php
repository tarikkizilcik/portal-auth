<?php

namespace kouosl\login\controllers\console;
use yii\console\Controller;

class UserController extends Controller{

    public function actionIndex(){
        $user = \Yii::$app->db
          ->createCommand("SELECT COUNT(*) FROM user")
          ->queryScalar();
        print_r($user);
        echo"\n";
        //var_dump($user);
    }
    public function actionUser(){
        \Yii::$app->db
        ->createCommand()
        ->insert('user', [
          'email'      => 'test4@example.com',
          'password_hash'   => md5('changeme7'),
          'username' => 'Test',
          'created_at' => time(),
          'updated_at' => time(),
          'access_token' => md5(time())

        ])
       ->execute();
    }
    public function actionUserUpdate(){
        \Yii::$app->db
        ->createCommand()
        ->update('user', [
        'updated_at' => time()
        ], '1 = 1')
        ->execute();
    }
    public function actionUserDelete(){
       
            \Yii::$app->db
             ->createCommand()
            ->delete('user', 'id = 9')
            ->execute();
        
       
    }
    public function actionUserBatch(){
        \Yii::$app->db
    ->createCommand()
    ->batchInsert('user', ['email', 'password_hash', 'username', 'created_at', 'updated_at','access_token'], 
    [
        ['james.franklin@example.com', md5('changeme7'), 'James', time(), time(),md5(time())],
        ['linda.marks@example.com', md5('changeme7'), 'Linda', time(), time(),md5(time()+1)],
        ['roger.martin@example.com', md5('changeme7'), 'Roger', time(), time(),md5(time()+2)]
    ])
    ->execute();
    }

}
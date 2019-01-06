<?php

/* @var $this yii\web\View */

$this->title = 'My Login Module';
use kouosl\theme\widgets\ButtonDropdown;
use \kouosl\login\Module;

$languages = ['tr-TR' => 'Türkçe','en-US' => 'English'];
 $lang = yii::$app->session->get('lang');
$lang = 'tr-TR';
$activeLangLabel = $languages[$lang];
unset($languages[$lang]);
$homes = Module::t('login','Home');
echo $homes;

?>

<div class="login-index">

    <div class="jumbotron">
	
        <h1><?php echo Module::t('login','This is Login Module!'); ?></h1>
        <p class="lead"><?php echo Module::t('login','If you have an account, you can go to the sign up page.')?></p><p class="lead"><?php echo Module::t('login','If not, dont worry, register now :)')?></p>

        <p><a class="btn btn-lg btn-success" href="auth/login">&raquo; <?php echo Module::t('login','Login')?> &raquo;</a></p>
		 <p><a class="btn btn-lg btn-success" href="auth/signup">&raquo; <?php echo Module::t('login','Sign Up')?> &raquo;</a></p>
		 
    </div>

   

    </div>
</div>

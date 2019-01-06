<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kouosl\theme\widgets\ButtonDropdown;
use kouosl\login\Module;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?php echo Module::t('login','Please fill out the following fields to login')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <?php echo Module::t('login','if you are not a signup you can')?> <?= Html::a('sign up', ['auth/signup']) ?>.
                </div>
				

                <div class="form-group">
						<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?></td>
						<?= yii\authclient\widgets\AuthChoice::widget([
							'baseAuthUrl' => ['auth/auth'],
                            'popupMode' => false,
                            'options' => [
                                'class' => 'auth-clients-holder'  
                            ]
								]) ?></td>
                </div>
				
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

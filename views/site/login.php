<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => "{input}\n<br>{error}"
    ],
]); ?>

    <h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username / E-mail']) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

    <?php if(\Yii::$app->session->hasFlash('eror')) : ?>
      <div class="alert alert-danger alert-dismissable" style="margin-top: 5%;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo \Yii::$app->session->getFlash('eror'); ?>
      </div>
    <?php endif; ?>

    <div class="form-actions text-center">
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"text-center\">{input}{label}</div>",
        ]) ?>
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

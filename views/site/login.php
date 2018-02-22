<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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

    <div class="form-actions text-center">
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"text-center\">{input}{label}</div>",
        ]) ?>
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

<?php ActiveForm::end(); ?>

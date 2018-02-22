<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\FormAsset;

FormAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="formulir">
	<?php $this->beginBody() ?>
		<div class="wrap">
			<?php
		    NavBar::begin([
		        'brandLabel' => Yii::$app->name,
		        'brandUrl' => Yii::$app->homeUrl,
		        'options' => [
		            'class' => 'navbar-inverse navbar-fixed-top',
		        ],
		    ]);
		    echo Nav::widget([
		        'options' => ['class' => 'navbar-nav navbar-right'],
		        'items' => [
		            ['label' => 'Home', 'url' => ['/site/index']],
		            Yii::$app->user->isGuest ? (
		                ['label' => 'Login', 'url' => ['/site/login']]
		            ) : (
		                '<li>'
		                . Html::beginForm(['/site/logout'], 'post')
		                . Html::submitButton(
		                    'Logout (' . Yii::$app->user->identity->username . ')',
		                    ['class' => 'btn btn-link logout']
		                )
		                . Html::endForm()
		                . '</li>'
		            )
		        ],
		    ]);
		    NavBar::end();
		    ?>
		    <div class="container">
				<div class="content">
					<?= $content ?>
				</div>
			</div>
			<div class="copyright"> 2018 © Maulana Prasetio. Aplikasi Test Online. </div>
		</div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
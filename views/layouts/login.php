<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\LoginAsset;

LoginAsset::register($this);
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
<body class="login">
	<?php $this->beginBody() ?>
		<div class="logo">
            <a href="index.html"><h3>Aplikasi Tes Online</h3> </a>
        </div>
		<div class="content">
			<?= $content ?>
		</div>
		<div class="copyright"> 2018 © Maulana Prasetio. Aplikasi Test Online. </div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
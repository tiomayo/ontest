<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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
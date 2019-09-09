<?php

/* @var $this \yii\web\View */
/* @var $content string */
use frontend\config\DefImport;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="google-site-verification" content="5VD4-oGZ4XNZg131M63y8at0hTC6rBYBbOClIMJa4vk" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119537596-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119537596-1');
    </script>

</head>
<body>

<?php $this->beginBody() ?>

<?= $this->render(
    'header.php'
) ?>
<?= Alert::widget() ?>
<?= $content ?>

<?= $this->render(
    'footer.php'
) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Showcase */

$this->title = Yii::t('backend', 'Create Showcase');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Showcases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="showcase-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'modelDetails2' => $modelDetails2,
    ]) ?>

</div>

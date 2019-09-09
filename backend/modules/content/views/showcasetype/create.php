<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShowcaseType */

$this->title = Yii::t('backend', 'Create Showcase Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Showcase Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="showcase-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShowcaseType */

$this->title = Yii::t('backend', 'Update Showcase Category: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Showcase Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="showcase-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

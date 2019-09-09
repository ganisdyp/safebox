<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ActivityType */

$this->title = Yii::t('backend', 'Update Study Trip Category: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Activity Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="activity-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

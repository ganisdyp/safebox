<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = Yii::t('backend', 'Update Activity: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="activity-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>

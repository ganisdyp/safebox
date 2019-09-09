<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActivityType */

$this->title = Yii::t('backend', 'Create Study Trip Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Activity Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

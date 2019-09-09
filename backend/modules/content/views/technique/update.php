<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Technique */

$this->title = 'Update Technique: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Techniques', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="technique-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

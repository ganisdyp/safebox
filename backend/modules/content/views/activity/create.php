<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = Yii::t('backend', 'Add Study Trip');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetails' => $modelDetails,
    ]) ?>

</div>

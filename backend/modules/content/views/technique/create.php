<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Technique */

$this->title = 'Create Technique';
$this->params['breadcrumbs'][] = ['label' => 'Techniques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technique-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

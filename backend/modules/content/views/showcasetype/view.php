<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ShowcaseType */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Showcase Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="showcase-type-view">

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="text-center">
        <?= Html::img(Yii::$app->getHomeUrl().'uploads/showcase_type/' . $model->main_photo,
            ['class'=>'thumbnail','width'=>'250']); ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
          //  'main_photo',
            [
                'attribute' => 'showcaseType.name_en',
                'value' => function ($model) {
                    return $model->name;
                },
                'label' => 'Name (EN)',
            ],
            [
                'attribute' => 'showcaseType.name_th',
                'value' => function ($model) {
                    return $model->name_th;
                },
                'label' => 'Name (TH)',
            ],
        ],
    ]) ?>

</div>

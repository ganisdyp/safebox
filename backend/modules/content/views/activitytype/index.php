<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\ActivityTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Study Trip Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-type-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Add Study Trip Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'main_photo',
                'format' => 'html',
                'value' => function ($dataProvider) {
                    return Html::img(Yii::$app->getHomeUrl().'uploads/activity_type/' . $dataProvider->main_photo,
                        ['class'=>'thumbnail','width'=>'80']);
                }
            ],
            [
                'attribute' => 'activityType.name_en',
                'value' => function ($dataProvider) {
                    return $dataProvider->name;
                },
                'label' => 'Name (EN)',
            ],
            [
                'attribute' => 'activityType.name_th',
                'value' => function ($dataProvider) {
                    $name_th = $dataProvider->getActivityTypeLangs()->where(['activity_type_lang.activity_type_id' => $dataProvider->id, 'activity_type_lang.language' => 'th'])->one();
                    return $name_th->name;
                },
                'label' => 'Name (TH)',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

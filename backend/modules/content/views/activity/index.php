<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Study Trip News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Add News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'activityType.name',
                'value' => function ($dataProvider) {
                    return $dataProvider->activityType->name;
                },
                'label' => 'Category',
            ],

            'headline',
            'date_published',
            ['attribute' => 'main_photo',
                'format' => 'html',
                'value' => function ($dataProvider) {

                    $media_type = $dataProvider->media_type;
                    if ($media_type == 1) {

                        return Html::img(Yii::$app->getHomeUrl() . 'uploads/activity/youtube-video-icon.png',
                            ['class' => 'thumbnail', 'width' => '100']);
                    } else {
                        return Html::img(Yii::$app->getHomeUrl() . 'uploads/activity/' . $dataProvider->main_photo,
                            ['class' => 'thumbnail', 'width' => '100']);
                    }

                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

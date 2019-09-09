<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\ShowcaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Showcases');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="showcase-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Showcase'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'showcaseType.name',
                'value' => function ($dataProvider) {
                    return $dataProvider->showcaseType->name;
                },
                'label' => 'Category',
            ],
            [
                'attribute' => 'technique.technique_name',
                'value' => function ($dataProvider) {
                    return $dataProvider->technique->technique_name;
                },
                'label' => 'Theme',
            ],
            [
                'attribute' => 'course.name',
                'value' => function ($dataProvider) {
                    return $dataProvider->course->name;
                },
                'label' => 'Course',
            ],
            //  'academic_year',
            //'academic_semester',
            //'date_published',
            ['attribute' => 'main_photo',
                'format' => 'html',
                'value' => function ($dataProvider) {
                    /*  $path_parts = pathinfo($dataProvider->main_photo);
                      $extension = $path_parts['extension'];*/

                    $media_type = $dataProvider->media_type;
                    if ($media_type == 1) {

                        return Html::img(Yii::$app->getHomeUrl() . 'uploads/showcase/youtube-video-icon.png',
                            ['class' => 'thumbnail', 'width' => '100']);
                    } else {
                        return Html::img(Yii::$app->getHomeUrl() . 'uploads/showcase/' . $dataProvider->main_photo,
                            ['class' => 'thumbnail', 'width' => '100']);
                    }

                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Courses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Add course'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'code',
            ['attribute' => 'main_photo',
                'format' => 'html',
                'value' => function ($dataProvider) {
                    return Html::img(Yii::$app->getHomeUrl().'uploads/course/' . $dataProvider->main_photo,
                        ['class'=>'thumbnail','width'=>'80']);
                }
            ],
            [
                'attribute' => 'course.name_en',
                'value' => function ($dataProvider) {
                    return $dataProvider->name;
                },
                'label' => 'Name (EN)',
            ],
            [
                'attribute' => 'course.name_th',
                'value' => function ($dataProvider) {
                    $name_th = $dataProvider->getCourseLangs()->where(['course_lang.course_id' => $dataProvider->id, 'course_lang.language' => 'th'])->one();
                    return $name_th->name;
                },
                'label' => 'Name (TH)',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

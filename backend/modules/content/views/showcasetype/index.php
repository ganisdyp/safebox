<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\ShowcaseTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Showcase Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="showcase-type-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            ['attribute' => 'main_photo',
                'format' => 'html',
                'value' => function ($dataProvider) {
                    return Html::img(Yii::$app->getHomeUrl().'uploads/showcase_type/' . $dataProvider->main_photo,
                        ['class'=>'thumbnail','width'=>'80']);
                }
            ],
            [
                'attribute' => 'showcaseType.name_en',
                'value' => function ($dataProvider) {
                    return $dataProvider->name;
                },
                'label' => 'Name (EN)',
            ],
            [
                'attribute' => 'showcaseType.name_th',
                'value' => function ($dataProvider) {
                    $name_th = $dataProvider->getShowcaseTypeLangs()->where(['showcase_type_lang.showcase_type_id' => $dataProvider->id, 'showcase_type_lang.language' => 'th'])->one();
                    return $name_th->name;
                },
                'label' => 'Name (TH)',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

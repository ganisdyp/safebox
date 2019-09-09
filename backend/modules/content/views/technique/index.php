<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content\models\TechniqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Techniques';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technique-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Technique', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'technique_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

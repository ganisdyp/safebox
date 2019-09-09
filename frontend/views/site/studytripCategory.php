<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\DC;
use common\models\ActivityTypeSearch;

$this->title = Yii::t('common', 'Study Trip');
$this->params['breadcrumbs'][] = $this->title;
$category_list = DC::get_menu_courses();
$searchModel = new ActivityTypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->query->where([]);
$activity_categories = $dataProvider->getModels();
define('PAGE_NAME', 'studytrip');
?>
<div id="activity-page" class="container">
    <?php ?>
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="/site/index"><?= Yii::t('common', 'Home'); ?></a></li>
            <li class="breadcrumb-item active"><?= Yii::t('common', 'Study Trip'); ?></li>
        </ol>
    </nav>
    <div class="row fadeIn animated d03s mt-3 mb-4">
        <?php foreach ($activity_categories as $activity_category) { ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card dc-card mb-4 corner-0 z-shadow fadeIn animated d03s">
                <a href="studytrip-list?id=<?= $activity_category->id; ?>&c=all" class="hover-box">
                    <div class="img-16by9 holder">
                        <img class="card-img-top img-responsive corner-0"
                                src="/backend/uploads/activity_type/<?= $activity_category->main_photo; ?>">
                    </div>
                </a>
                <div class="card-body text-center">
                    <a href="studytrip-list?id=<?= $activity_category->id; ?>&c=all"
                        class="card-title font-weight-normal bigger-110 my-0 block"><?= $activity_category->name; ?></a>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>
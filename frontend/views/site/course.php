<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\CourseSearch;

$this->title = Yii::t('common', 'Courses');
$this->params['breadcrumbs'][] = $this->title;

$searchModel = new CourseSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$courses = $dataProvider->query->where([])->orderBy(['code'=>SORT_ASC])->all();
define('PAGE_NAME', 'course');
?>
<div id="course-page" class="container">
    <?php /*
  <div class="page-header fadeIn animated d03s" style="background-image: url(http://smartyschool.stylemixthemes.com/university/wp-content/uploads/2016/09/bg-shop.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="header-content">
            <p class="title h3 bold text-uppercase">Courses</p>
            <p class="mb-0">Lorem ipsum dolor sit amet</p>
          </div>
        </div>
      </div>
    </div>
    <div class="page-header-overlay"></div>
  </div>
  */ ?>
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');;?></a></li>
            <li class="breadcrumb-item active"><?php echo Yii::t('common', 'Courses');;?></li>
        </ol>
    </nav>
    <div class="row mt-3 mb-4">
        <?php foreach ($courses as $course) { ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card dc-card mb-4 corner-0 z-shadow fadeIn animated d03s">
                <a href="course-view?c=<?= $course->id; ?>" class="hover-box">
                    <div class="img-16by9 holder">
                        <img class="card-img-top img-responsive corner-0"
                                src="/backend/uploads/course/<?= $course->main_photo; ?>">
                    </div>
                </a>
                <div class="card-body text-center">
                    <a href="course-view?c=<?= $course->id; ?>"
                        class="card-title font-weight-normal bigger-110 my-0 block"><?= $course->name ." | ". $course->code; ?></a>
                    <?php /* <p class="card-text smaller-90"><?= $course->description; ?></p> */ ?>
                </div>
                <?php /*
                <div class="card-footer">
                    <a href="course-view?c=<?= $course->id; ?>" class="smaller-90 dc-link"><?php echo Yii::t('common', 'learn_more');?> <i class="fa fa-angle-right ml-1"></i></a>
                </div>
                */ ?>
            </div>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>
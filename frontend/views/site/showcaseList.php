<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use frontend\models\DC;
use common\models\CourseSearch;
use common\models\ShowcaseSearch;
use common\models\ShowcaseTypeSearch;
define('PAGE_NAME', 'showcase');
$this->title = Yii::t('common', 'Design Showcase');
$this->params['breadcrumbs'][] = $this->title;
$category_list = DC::get_menu_courses();

$searchModel = new ShowcaseTypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$showcase_category = $dataProvider->query->where(['id' => $_GET['id']])->one();

$searchModel = new CourseSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$courses = $dataProvider->query->where([])->orderBy(['code'=>SORT_ASC])->all();

$searchModel = new ShowcaseSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//$showcases_per_category = $dataProvider->getModels();

$filter = '';

if (isset($_GET['c']) && $_GET['c']!='all') {
    $filter = $_GET['c'];
?>
<div id="showcase-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90 mb-0">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/showcase-category"><?php echo Yii::t('common', 'Design Showcase');?></a></li>
            <li class="breadcrumb-item active"><?= $showcase_category->name; ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 fadeIn animated d03s">
            <p class="bigger-160 font-weight-normal text-purple mb-1"><?= $showcase_category->name; ?></p>
            <div class=""><?= $showcase_category->description; ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill">
                <?php foreach ($courses as $course) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($course->id == $filter) ? 'active' : ''; ?>"
                        href="/site/showcase-list?id=<?php echo $_GET['id']; ?>&c=<?= $course->id; ?>"><?= $course->name; ?></a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ('all' == $filter) ? 'active' : ''; ?>"
                        href="/site/showcase-list?id=<?php echo $_GET['id']; ?>&c=all"><?php echo Yii::t('common', 'all');?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <?php $showcases_per_category = $dataProvider->query->where(['showcase_type_id' => $_GET['id'], 'course_id' => $_GET['c']])->all(); ?>
        <?php foreach ($showcases_per_category as $showcase) { ?>
            <div class="col-lg-3 col-md-4 col-12 fadeIn animated d03s">
                <a href="/site/showcase-view?id=<?php echo $showcase->id; ?>" class="block">
                    <div class="media-wrapper corner-1">
                        <?php $media_type = $showcase->media_type;
                        if ($media_type == 1) { ?>
                            <iframe width="100%" height="150" src="<?= $showcase->main_photo;?>" allowfullscreen></iframe>
                        <?php } else { ?>
                            <div class="img-16by9 holder corner-1">
                                <img class="card-img-top img-responsive" src="/backend/uploads/showcase/<?= $showcase->main_photo; ?>">
                            </div>
                        <?php } ?>
                        <div class="media-overlay corner-1"></div>
                    </div>
                </a>
                <a href="/site/showcase-view?id=<?= $showcase->id; ?>" class="mt-2 mb-3 block bold"><?= $showcase->name; ?></a>
            </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php } elseif(isset($_GET['c']) && $_GET['c']=='all'){
    $filter = 'all';
?>
<div id="showcase-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/showcase-category"><?php echo Yii::t('common', 'Design Showcase');?></a></li>
            <li class="breadcrumb-item active"><?= $showcase_category->name; ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 fadeIn animated d03s">
            <p class="h4 bold mb-2"><?= $showcase_category->name; ?></p>
            <div class=""><?= $showcase_category->description; ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-fill">
                <?php foreach ($courses as $course) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($course->id == $filter) ? 'active' : ''; ?>"
                        href="/site/showcase-list?id=<?php echo $_GET['id']; ?>&c=<?= $course->id; ?>"><?= $course->name; ?></a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ('all' == $filter) ? 'active' : ''; ?>"
                        href="/site/showcase-list?id=<?php echo $_GET['id']; ?>&c=all"><?php echo Yii::t('common', 'all');?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <?php $showcases_per_category = $dataProvider->query->where(['showcase_type_id' => $_GET['id']])->all(); ?>
        <?php foreach ($showcases_per_category as $showcase) { ?>
            <div class="col-lg-3 col-md-4 col-12 fadeIn animated d03s">
                <a href="/site/showcase-view?id=<?php echo $showcase->id; ?>" class="block">
                    <div class="media-wrapper corner-1">
                        <?php $media_type = $showcase->media_type;
                        if ($media_type == 1) { ?>
                            <!--  <div class="card-img-top img-responsive corner-0">-->
                            <iframe width="100%" height="150" src="<?= $showcase->main_photo;?>" allowfullscreen></iframe>
                            <!-- </div>-->
                        <?php } else { ?>
                            <div class="img-16by9 holder corner-1">
                                <img class="card-img-top img-responsive" src="/backend/uploads/showcase/<?= $showcase->main_photo; ?>">
                            </div>
                        <?php } ?>
                        <div class="media-overlay corner-1"></div>
                    </div>
                </a>
                <a href="/site/showcase-view?id=<?= $showcase->id; ?>" class="mt-2 mb-3 block bold"><?= $showcase->name; ?></a>
            </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<?php } ?>

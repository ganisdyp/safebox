<?php
use common\models\BlogSearch;
/* @var $this yii\web\View */
/* Yii::$app->db->open();*/
$this->title = Yii::t('common', 'Home');
$searchModel = new BlogSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
define('PAGE_NAME', 'index');
?>
<div id="index-page">
    <div class="fadeIn animated d05s">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="8000">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../images/home/EDIT-P1030277_crop_re.png">
                    <div class="carousel-content higher">
                    <?php
                        echo '<div class="d-lg-block d-md-block d-none">';
                        echo '<p class="h4 smaller bold line-height-125">';
                        echo Yii::t('common', 'HeroTitle_1_1').' ';
                        echo '<span class="text-uppercase bigger-140">'.Yii::t('common', 'HeroTitle_1_2').'</span>';
                        echo '<br>'.Yii::t('common', 'and').' ';
                        echo '<span class="text-uppercase bigger-140">'.Yii::t('common', 'HeroTitle_2_1').'</span> ';
                        echo Yii::t('common', 'HeroTitle_2_2');
                        echo '</p>';
                        echo '<p class="mt-4 font-weight-normal">'.Yii::t('common', 'HeroTitle_3').'</p>';
                        echo '</div>';
                    ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../images/home/EDIT-IMG_20170420_132640.png">
                    <div class="carousel-content higher">
                        <?php
                            echo '<div class="d-lg-block d-md-block d-none">';
                        echo '<p class="h4 smaller bold line-height-125">';
                        echo Yii::t('common', 'HeroTitle_1_1').' ';
                        echo '<span class="text-uppercase bigger-140">'.Yii::t('common', 'HeroTitle_1_2').'</span>';
                        echo '<br>'.Yii::t('common', 'and').' ';
                        echo '<span class="text-uppercase bigger-140">'.Yii::t('common', 'HeroTitle_2_1').'</span> ';
                        echo Yii::t('common', 'HeroTitle_2_2');
                        echo '</p>';
                        echo '<p class="mt-4 font-weight-normal">'.Yii::t('common', 'HeroTitle_3').'</p>';
                        echo '</div>';
                    ?>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../images/home/EDIT-IMG_20170420_132747.jpg">
                    <div class="carousel-content higher">
                        <?php
                        echo '<div class="d-lg-block d-md-block d-none">';
                        echo '<p class="h4 smaller bold line-height-125">';
                        echo Yii::t('common', 'HeroTitle_1_1').' ';
                        echo '<span class="text-uppercase bigger-140">'.Yii::t('common', 'HeroTitle_1_2').'</span>';
                        echo '<br>'.Yii::t('common', 'and').' ';
                        echo '<span class="text-uppercase bigger-140">'.Yii::t('common', 'HeroTitle_2_1').'</span> ';
                        echo Yii::t('common', 'HeroTitle_2_2');
                        echo '</p>';
                        echo '<p class="mt-4 font-weight-normal">'.Yii::t('common', 'HeroTitle_3').'</p>';
                        echo '</div>';
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4 mb-lg-3 mb-0">
            <div class="col-lg-8 col-12">
                <p class="bigger-130 text-purple mb-3 line-height-150 viewpoint-animate d03s" data-animation="fadeInDown">
                    <?php
                    echo Yii::t('common', 'Content_Title_1');
                    echo '<span class="text-uppercase">'.Yii::t('common', 'Content_Title_2').'</span>';
                    echo Yii::t('common', 'and');
                    echo '<span class="text-uppercase">'.Yii::t('common', 'Content_Title_3').'</span>';
                    echo Yii::t('common', 'Content_Title_4');
                    ?>
                </p>
                <p class="viewpoint-animate d03s font-chatthai" data-animation="fadeIn">
                    <?php
                    echo Yii::t('common', 'Content_1_1');
                    echo '<sup>'.Yii::t('common', 'sup_1').'</sup>';
                    echo Yii::t('common', 'Content_1_2');
                    echo '<sup>'.Yii::t('common', 'sup_2').'</sup>';
                    echo Yii::t('common', 'Content_1_3');
                    echo '<sup>'.Yii::t('common', 'sup_3').'</sup>';
                    echo Yii::t('common', 'full_stop');
                    ?>
                </p>
                <p class="mt-4 mb-2 viewpoint-animate d03s font-chatthai" data-animation="fadeIn">
                    <?php
                    echo Yii::t('common', 'Content_2_1');
                    echo '<span class="text-purple h6">'.Yii::t('common', 'Content_2_2').'</span>';
                    echo Yii::t('common', 'Content_2_3');
                    ?>
                </p>
                <ul class="viewpoint-animate d03s font-chatthai" data-animation="fadeIn">
                    <?php
                    echo '<li>'.Yii::t('common', 'Content_3_1').'</li>';
                    echo '<li>'.Yii::t('common', 'Content_3_2').'</li>';
                    echo '<li>'.Yii::t('common', 'Content_3_3').'</li>';
                    ?>
                </ul>
                <p class="mt-4 mb-2 viewpoint-animate d03s font-chatthai" data-animation="fadeIn">
                    <?php
                    echo Yii::t('common', 'Content_4_1');
                    echo '<span class="text-purple h6">'.Yii::t('common', 'Content_4_2').'</span>';
                    echo Yii::t('common', 'Content_4_3');
                    ?>
                </p>
                <ul class="viewpoint-animate d03s font-chatthai" data-animation="fadeIn">
                    <?php
                    echo '<li>'.Yii::t('common', 'Content_5_1').'</li>';
                    echo '<li>'.Yii::t('common', 'Content_5_2').'</li>';
                    if(isset($_COOKIE['language'])) {
                        if(Yii::$app->language == 'th-TH'){
                            echo '<li id="index-1200">'.Yii::t('common', 'Content_5_3_extra_1');
                            echo '<br>';
                            echo Yii::t('common', 'Content_5_3_extra_2').'</li>';
                            echo '<li id="index-1199" class="hidden">'.Yii::t('common', 'Content_5_3').'</li>';
                        } else {
                            echo '<li>'.Yii::t('common', 'Content_5_3').'</li>';
                        }
                    }
                    ?>
                </ul>
                <div class="mt-4 viewpoint-animate d03s font-chatthai" data-animation="fadeIn">
                    <div class="float-left mr-3">
                        <sup>1</sup>
                    </div>
                    <div class="inline">
                        <?php echo Yii::t('common', 'Content_6'); ?>
                        <br>P21: 	<a class="ml-2" href="http://www.p21.org/">http://www.p21.org/</a>
                        <br>CEFR:	<a class="" href="https://www.coe.int/en/web/common-european-framework-reference-languages">https://www.coe.int/en/web/common-european-framework-reference-languages</a>
                    </div>
                </div>
            </div>

            <!-- start Blogs -->
            <div class="col-lg-4 col-12 mt-lg-0 mt-4">
                <div id="fieldtrip" class="main-section">
                    <div class="list-group viewpoint-animate d03s z-shadow" data-animation="fadeInRight">
                        <a href="fieldtrip.php" class="list-group-item list-group-item-action flex-column align-items-start py-1 active corner-0">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="my-1 text-uppercase"><?php echo Yii::t('common', 'News');?></p>
                            </div>
                        </a>
                        <?php $recent_activities_list = $dataProvider->query->where([])->orderBy(['date_visited' => SORT_DESC])->all(); ?>
                        <?php foreach($recent_activities_list as $blog) {
                            if($blog->blogType->id == 1) {
                                $type = 'Animation studios';
                            } else if($blog->blogType->id == 2) {
                                $type = 'Game companies';
                            } else if($blog->blogType->id == 3) {
                                $type = 'Local enterprises';
                            } else {
                                $type = $blog->blogType->name;
                            }
                            ?>
                            <a href="/site/blog-view?id=<?= $blog->id; ?>" class="list-group-item list-group-item-action flex-column align-items-start py-2">
                            <div class="badge badge-custom"><?php echo $type;?></div>
                                <div class="row no-gutters">
                                    <div class="col-4 pr-3">
                                        <?php $media_type = $blog->media_type;
                                        if ($media_type == 1) { ?>
                                                <iframe width="100%" height="90"
                                                        src="<?= $blog->main_photo; ?>"></iframe>
                                        <?php } else { ?>

                                            <div class="img-1by1 holder">
                                                <img class="img-responsive corner-0"
                                                     src="/backend/uploads/blog/<?= $blog->main_photo; ?>">

                                            </div>
                                        <?php } ?>

                                    </div>
                                    <div class="col-8">
                                        <?php $date_visited = date_create($blog->date_visited); ?>
                                        <small class="smaller-80 text-muted"><?= date_format($date_visited, "j F Y") ?></small>
                                        <p class="mt-1 mb-1"><?= $blog->headline; ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                        <div href="/site/blog-category" class="list-group-item list-group-item-action flex-column align-items-start py-1 corner-0">
                            <a href="/site/blog-category" class="smaller-90 py-2 block"><?php echo Yii::t('common', 'AllNews');?> <i class="fa fa-angle-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Blogs -->
        </div>
    </div>

    <div class="">
        <div class="container">
            <div class="row pt-4 pb-5 align-items-center">
                <div class="col-lg-6 col-12 viewpoint-animate d03s mb-lg-0 mb-4" data-animation="fadeIn">
                    <?php
                    echo '<p class="mb-0 text-center">';
                    echo Yii::t('common', 'Sponsor_1');
                    echo '<br>';
                    echo Yii::t('common', 'Sponsor_2');
                    echo '</p>';
                    ?>
                </div>
                <div class="col-lg-6 col-12 text-center viewpoint-animate d03s" data-animation="fadeIn">
                    <div id="sponsors">
                        <img src="/images/camt_vertical.png" class="img-responsive mx-2 mb-lg-0 mb-3" style="width: 120px;">
                        <img src="/images/logo-en.png" class="img-responsive mx-3 mb-lg-0 mb-3" style="width: 150px;">
                        <img src="/images/cmu_logo.png" class="img-responsive mx-3" style="width: 100px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
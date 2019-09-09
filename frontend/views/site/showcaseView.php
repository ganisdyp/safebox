<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 5/4/2018
 * Time: 1:25 AM
 */
use common\models\ShowcaseSearch;
use common\components\Content;
use yii\helpers\Html;

$this->title = Yii::t('common', 'Design Showcase');
$searchModel = new ShowcaseSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$showcase = $dataProvider->query->where(['id' => $_GET['id']])->one();
define('PAGE_NAME', 'showcase');
?>
<div id="showcase-page" class="container">
    <nav class="mt-2">
        <ol class="breadcrumb smaller-90 mb-2">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/showcase-category"><?php echo Yii::t('common', 'Design Showcase');?></a></li>
            <li class="breadcrumb-item bold"><a href="/site/showcase-list?id=<?= $showcase->showcaseType->id; ?>&c=all"><?= $showcase->showcaseType->name; ?></a>
            </li>
            <li class="breadcrumb-item active"><?= $showcase->name; ?></li>
        </ol>
    </nav>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12">
            <p class="bigger-160 mb-1 text-purple font-weight-normal"><?= $showcase->name; ?></p>
        </div>
        <?php /*
        <div class="col-md-6 col-12">
            <p class="text-muted smaller-90 my-1">
                // <?php <i class="fa fa-clock-o mr-2"></i> ;?>
                <span>Updated on: </span>
                <?php
                $date_publish = date_create($showcase->date_published);

                ?>
                <?= date_format($date_publish, "D, j M Y h:i A") ?>
            </p>
        </div>
        */ ?>
    </div>
    <div class="row mt-3 mb-5">
        <div class="col-lg-5 col-12">
            <?php $media_type = $showcase->media_type;
            if ($media_type == 1) { ?>
                <iframe width="100%" height="280" src="<?= $showcase->main_photo;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="allowfullscreen"></iframe>
            <?php } else { ?>
                <a href="/backend/uploads/showcase/<?= $showcase->main_photo; ?>" data-lightbox="trip">
                <div class="img-16by9 holder">
                    <img class="card-img-top img-responsive corner-0"
                         src="/backend/uploads/showcase/<?= $showcase->main_photo; ?>">
                </div>
                </a>
            <?php } ?>
            <div class="row no-gutters mt-3">
                <?php
                $related_photos = $showcase->getShowcaseProfiles()->where(['showcase_id' => $showcase->id])->all();
                foreach ($related_photos as $photo) { ?>
                    <div class="col-2 pr-2 mb-2">
                        <a href="<?= Yii::$app->getHomeUrl() . 'backend/uploads/showcase/related_photo/' . $photo->showcase_url; ?>"
                           data-lightbox="trip">
                            <div class="img-1by1 holder">
                                <?= Html::img(Yii::$app->getHomeUrl() . 'backend/uploads/showcase/related_photo/' . $photo->showcase_url,
                                    ['class' => 'thumbnail inline', 'width' => '100']) . " "; ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-7 col-12">
            <div class="row mb-2">
                <div class="col-md-6 col-12">
                    <p class="text-muted smaller-90 my-1">
                        <?php /* <i class="fa fa-group mr-2"></i> */ ?>
                        <span>Subject: </span>
                        <?= $showcase->course->name . " (" . $showcase->course->code . ")"; ?>
                    </p>
                </div>
                <?php if($showcase->from_date) { ?>
                <div class="col-md-6 col-12">
                    <p class="text-muted smaller-90 my-1">
                        <i class="fa fa-group mr-2"></i>
                        <?php
                        $from_date_arr = explode(" ", $showcase->from_date);
                        $to_date_arr = explode(" ", $showcase->to_date);
                        if ($from_date_arr[1] == $to_date_arr[1]) {
                            $study_period = $from_date_arr[0] . " -> " . $to_date_arr[0] . " " . $to_date_arr[1];
                        } else {
                            $study_period = $showcase->from_date . " -> " . $showcase->to_date;
                        }
                        ?>
                        <?= $study_period; ?>
                    </p>
                </div>
                <?php } ?>
            </div>
            <hr class="d-lg-none d-block">
            <div class=""> <?= $showcase->description; ?> </div>
            <?php
            $related_students = $showcase->getShowcaseOwners()->where(['showcase_id' => $showcase->id])->orderBy(['student_code'=>SORT_ASC])->all();
            ?>
            <div class="py-2 smaller-90">
                <?php foreach ($related_students as $student) { ?>
                    <li><?= "<b>".$student->student_code."</b> ".$student->first_name . " " . $student->last_name ." /". (Content::getFacultyLabel($student->faculty)) ?></li>
                <?php } ?>
            </div>
            <hr>

            <?php /* <i class="fa fa-map mr-2"></i> */ ?>
            <span>Techniques/themes: </span>
            <?php
            if($showcase->technique) { 
            echo "<span title='Technique' class='badge badge-dark' style='font-size:11pt; font-weight:normal;'><b>" . $showcase->technique->technique_name . " </b></span> ";
            }
            if($showcase->keyword) {
                $keywords = explode(",", $showcase->keyword);
                foreach ($keywords as $keyword) {
                    echo "<span title='Keyword' class='badge badge-info' style='font-size:11pt; font-weight:normal;'> <b>" . ltrim(rtrim($keyword)) . " </b></span> ";
                }
            }
            echo "<br>";
            ?>
            <p class="text-muted smaller-90 my-1">
            </p>
        </div>
        <div class="col-12 text-center mt-4 pagination-showcase">
        <?php
        $dataProvider2 = $searchModel->search(Yii::$app->request->queryParams);
        $all_showcases = $dataProvider2->query->where(['showcase_type_id' => $showcase->showcaseType->id])->all();
        $item_count = 1;
        foreach($all_showcases as $sc){
            $active = '';
            if($sc->id == $_GET['id']) {
                $active = 'active';
            }

            echo "<span title='' class='badge badge-light ".$active."' style='font-size:11pt; font-weight:normal;'><a href='/site/showcase-view?id=$sc->id'>".$item_count."</a></span> ";
            $item_count++;
        }
        ?>
        </div>
    </div>
</div>
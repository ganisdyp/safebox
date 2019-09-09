<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 5/4/2018
 * Time: 1:25 AM
 */
use common\models\ActivitySearch;
use yii\helpers\Html;

$this->title = Yii::t('common', 'Study Trip');
$searchModel = new ActivitySearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$activity = $dataProvider->query->where(['id' => $_GET['id']])->one();
define('PAGE_NAME', 'studytrip');
?>
<div id="activity-page" class="container">
    <nav class="mt-2">
        <ol class="breadcrumb smaller-90 mb-2">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/studytrip-category"><?php echo Yii::t('common', 'Study Trip');?></a></li>
            <li class="breadcrumb-item bold"><a
                        href="/site/studytrip-list?id=<?= $activity->activityType->id; ?>&c=all"><?= $activity->activityType->name; ?></a>
            </li>
            <li class="breadcrumb-item active"><?= $activity->headline; ?></li>
        </ol>
    </nav>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12">
            <?php $date_visited = date_create($activity->date_visited); ?>
            <p class="bigger-160 mb-1 text-purple font-weight-normal"><?= strtoupper(date_format($date_visited, "j F Y")." – ".$activity->headline); ?></p>
        </div>
        <div class="col-md-6 col-12">
            <p class="text-muted smaller-90 my-1">
              <!--  <i class="fa fa-clock-o mr-2"></i>-->
                <?php
                $date_publish = date_create($activity->date_published);
                ?>
                <?//= date_format($date_publish, "D, j M Y h:i A") ?>
            </p>
        </div>
    </div>
    <div class="row mt-3 mb-5">
        <div class="col-lg-5 col-12">
            <?php $media_type = $activity->media_type;
            if ($media_type == 1) { ?>
                <iframe width="100%" height="280" src="<?= $activity->main_photo;?>" allowfullscreen></iframe>
            <?php } else { ?>
                <a href="/backend/uploads/activity/<?= $activity->main_photo; ?>" data-lightbox="trip">
                    <div class="img-16by9 holder">
                        <img class="card-img-top img-responsive corner-0"
                            src="/backend/uploads/activity/<?= $activity->main_photo; ?>">
                    </div>
                </a>
            <?php } ?>

            <div class="row no-gutters mt-3">
                <?php
                $related_photos = $activity->getActivityPhotos()->where(['activity_id' => $activity->id])->all();

                foreach ($related_photos as $photo) { ?>
                    <div class="col-2 pr-2 mb-2">
                        <a href="<?= Yii::$app->getHomeUrl() . 'backend/uploads/activity/related_photo/' . $photo->photo_url; ?>" data-lightbox="trip">
                            <div class="img-1by1 holder">
                                <?= Html::img(Yii::$app->getHomeUrl() . 'backend/uploads/activity/related_photo/' . $photo->photo_url,
                                    ['class' => 'thumbnail inline', 'width' => '100']) . " "; ?>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-7 col-12">
            <div class="row mb-2">
                <div class="col-12">
                    <p class="text-muted smaller-90 my-1">
                        <i class="fa fa-group mr-2"></i>
                        <?= $activity->participant." ".Yii::t('common','people joined this activity'); ?>
                    </p>
                </div>
                <div class="col-12">
                    <p class="text-muted smaller-90 my-1">
                        <i class="fa fa-map mr-2"></i>
                        <?= $activity->location; ?>
                    </p>
                </div>
            </div>
            <hr class="my-2">
            <div class=""> <?= $activity->description; ?></div>
        </div>
    </div>
</div>
</div>

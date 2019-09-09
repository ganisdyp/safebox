<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Showcase */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Showcases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="showcase-view">

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="text-center">
        <?php
        /* $path_parts = pathinfo($model->main_photo);
         $extension = $path_parts['extension'];*/
        //echo $extension;
        $media_type = $model->media_type;
        if ($media_type == 1) {  /* echo "<video id='current_media' width='480' controls controlsList=\"nodownload\">";
            echo "<source src='" . Yii::$app->getHomeUrl() . 'uploads/showcase/' . $model->main_photo . "'  type='video/mp4'>";
            echo "</video>";*/
            ?>

            <iframe width="480" height="320" src="<?= $model->main_photo; ?>"
                    allowfullscreen></iframe>
        <?php } else {
            echo Html::img(Yii::$app->getHomeUrl() . 'uploads/showcase/' . $model->main_photo,
                ['class' => 'thumbnail', 'width' => '250']);
        }

        ?>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            //  'id',
            'name',
            'technique.technique_name',
            //'course.name',
            /*[
                'attribute' => 'course.name',
                'value' => function ($model) {
                    $name_en = $model->course->getCourseLangs()->where(['course_lang.course_id' => $model->course_id, 'course_lang.language' => 'en'])->one();
                    $name_th = $model->course->getCourseLangs()->where(['course_lang.course_id' => $model->course_id, 'course_lang.language' => 'th'])->one();
                    return $name_en->name." (".$name_th->name.")";

                },
                'label' => 'Course',
            ], */
            [
                'attribute' => 'showcaseType.name',
                'value' => function ($model) {
                    $name_en = $model->showcaseType->getShowcaseTypeLangs()->where(['showcase_type_lang.showcase_type_id' => $model->showcase_type_id, 'showcase_type_lang.language' => 'en'])->one();
                    $name_th = $model->showcaseType->getShowcaseTypeLangs()->where(['showcase_type_lang.showcase_type_id' => $model->showcase_type_id, 'showcase_type_lang.language' => 'th'])->one();
                    return $name_en->name . " (" . $name_th->name . ")";

                },
                'label' => 'Category',
            ],
            [
                'attribute' => 'from_date',
                'value' => function ($model) {
                    if($model->from_date) {
                        $from_date_arr = explode(" ", $model->from_date);
                        $to_date_arr = explode(" ", $model->to_date);
                        if ($from_date_arr[1] == $to_date_arr[1]) {
                            return $from_date_arr[0] . " - " . $to_date_arr[0] . " " . $to_date_arr[1];
                        } else {
                            return $model->from_date . " - " . $model->to_date;
                        }
                    }


                },
                'label' => 'Study Period',
            ],
            'date_published',

        ],
    ]) ?>

    <?php

    echo "<div class='row' style='text-align:left; margin-left:1px;'>";
    echo "<span title='Related course' class='label label-default' style='font-size:12pt; font-weight:normal;'>" . $model->course->name . "</span> ";

    $keywords = explode(",", $model->keyword);
    //   print_r($keywords);
    foreach ($keywords as $keyword) {
        echo "<span title='Keyword' class='label label-primary' style='font-size:12pt; font-weight:normal;'>" . rtrim($keyword) . "</span> ";
    }
    // echo " <span title='Theme' class='label label-primary' style='font-size:12pt; font-weight:normal;'>" . $model->technique->technique_name . "</span>";
    echo "</div>";
    echo "<br>";

    $related_photos = $model->getShowcaseProfiles()->where(['showcase_id' => $model->id])->all();

    foreach ($related_photos as $photo) {

        echo Html::img(Yii::$app->getHomeUrl() . 'uploads/showcase/related_photo/' . $photo->showcase_url,
                ['class' => 'thumbnail inline', 'width' => '100']) . " ";
    }


    $this->registerJs(' 
//checkFile("' . $model->main_photo . '");
    
function checkFile(file) {
  var extension = file.substr((file.lastIndexOf(' . ') +1));
  if (!/(mp4)$/ig.test(extension)) {
     //alert("Image!");
     $(\'#video-box\').hide();
     $(\'#image-box\').show();
  }else{
     //alert("Video!");
     $(\'#image-box\').hide();
     $(\'#video-box\').show();
  }
}
    ', \yii\web\View::POS_READY);

    ?>

</div>

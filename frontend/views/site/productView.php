<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 5/4/2018
 * Time: 1:25 AM
 */
use common\models\ProductSearch;
use common\components\Content;
use yii\helpers\Html;

$this->title = Yii::t('common', 'Product');
$searchModel = new ProductSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$product = $dataProvider->query->where(['id' => $_GET['id']])->one();
define('PAGE_NAME', 'product');
?>
<div id="product-page" class="container">
    <nav class="mt-2">
        <ol class="breadcrumb smaller-90 mb-2">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item"><a href="/site/product-category"><?php echo Yii::t('common', 'Product');?></a></li>
            <li class="breadcrumb-item bold"><a href="/site/product-list?id=<?= $product->productType->id; ?>&c=all"><?= $product->productType->name; ?></a>
            </li>
            <li class="breadcrumb-item active"><?= $product->name; ?></li>
        </ol>
    </nav>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12">
            <p class="bigger-160 mb-1 text-purple font-weight-normal"><?= $product->name; ?></p>
        </div>
        <?php /*
        <div class="col-md-6 col-12">
            <p class="text-muted smaller-90 my-1">
                // <?php <i class="fa fa-clock-o mr-2"></i> ;?>
                <span>Updated on: </span>
                <?php
                $date_publish = date_create($product->date_published);

                ?>
                <?= date_format($date_publish, "D, j M Y h:i A") ?>
            </p>
        </div>
        */ ?>
    </div>
    <div class="row mt-3 mb-5">
        <div class="col-lg-5 col-12">
            <?php $media_type = $product->media_type;
            if ($media_type == 1) { ?>
                <iframe width="100%" height="280" src="<?= $product->main_photo;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="allowfullscreen"></iframe>
            <?php } else { ?>
                <a href="/backend/uploads/product/<?= $product->main_photo; ?>" data-lightbox="trip">
                <div class="img-16by9 holder">
                    <img class="card-img-top img-responsive corner-0"
                         src="/backend/uploads/product/<?= $product->main_photo; ?>">
                </div>
                </a>
            <?php } ?>
            <div class="row no-gutters mt-3">
                <?php
                $related_photos = $product->getProductPhotos()->where(['product_id' => $product->id])->all();
                foreach ($related_photos as $photo) { ?>
                    <div class="col-2 pr-2 mb-2">
                        <a href="<?= Yii::$app->getHomeUrl() . 'backend/uploads/product/related_photo/' . $photo->product_url; ?>"
                           data-lightbox="trip">
                            <div class="img-1by1 holder">
                                <?= Html::img(Yii::$app->getHomeUrl() . 'backend/uploads/product/related_photo/' . $photo->product_url,
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
                        <?= $product->brand->name . " (" . $product->brand->code . ")"; ?>
                    </p>
                </div>
                <?php if($product->from_date) { ?>
                <div class="col-md-6 col-12">
                    <p class="text-muted smaller-90 my-1">
                        <i class="fa fa-group mr-2"></i>
                        <?php
                        $from_date_arr = explode(" ", $product->from_date);
                        $to_date_arr = explode(" ", $product->to_date);
                        if ($from_date_arr[1] == $to_date_arr[1]) {
                            $study_period = $from_date_arr[0] . " -> " . $to_date_arr[0] . " " . $to_date_arr[1];
                        } else {
                            $study_period = $product->from_date . " -> " . $product->to_date;
                        }
                        ?>
                        <?= $study_period; ?>
                    </p>
                </div>
                <?php } ?>
            </div>
            <hr class="d-lg-none d-block">
            <div class=""> <?= $product->description; ?> </div>
            <?php
            $related_students = $product->getProductOwners()->where(['product_id' => $product->id])->orderBy(['student_code'=>SORT_ASC])->all();
            ?>
            <div class="py-2 smaller-90">
                <?php foreach ($related_students as $student) { ?>
                    <li><?= "<b>".$student->student_code."</b> ".$student->first_name . " " . $student->last_name ." /". (Content::getFacultyLabel($student->faculty)) ?></li>
                <?php } ?>
            </div>
            <hr>

            <?php /* <i class="fa fa-map mr-2"></i> */ ?>
            <span>Tags/themes: </span>
            <?php
            if($product->tag) {
            echo "<span title='Tag' class='badge badge-dark' style='font-size:11pt; font-weight:normal;'><b>" . $product->tag->tag . " </b></span> ";
            }
            if($product->keyword) {
                $keywords = explode(",", $product->keyword);
                foreach ($keywords as $keyword) {
                    echo "<span title='Keyword' class='badge badge-info' style='font-size:11pt; font-weight:normal;'> <b>" . ltrim(rtrim($keyword)) . " </b></span> ";
                }
            }
            echo "<br>";
            ?>
            <p class="text-muted smaller-90 my-1">
            </p>
        </div>
        <div class="col-12 text-center mt-4 pagination-product">
        <?php
        $dataProvider2 = $searchModel->search(Yii::$app->request->queryParams);
        $all_products = $dataProvider2->query->where(['product_type_id' => $product->productType->id])->all();
        $item_count = 1;
        foreach($all_products as $sc){
            $active = '';
            if($sc->id == $_GET['id']) {
                $active = 'active';
            }

            echo "<span title='' class='badge badge-light ".$active."' style='font-size:11pt; font-weight:normal;'><a href='/site/product-view?id=$sc->id'>".$item_count."</a></span> ";
            $item_count++;
        }
        ?>
        </div>
    </div>
</div>
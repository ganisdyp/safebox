<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\DC;
use common\models\ProductTypeSearch;
define('PAGE_NAME', 'product');
$this->title = Yii::t('common', 'Product');
$this->params['breadcrumbs'][] = $this->title;
$category_list = DC::get_menu_brands();
$searchModel = new ProductTypeSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->query->where([]);
$product_categories = $dataProvider->getModels();

?>
<div id="product-page" class="container">
    <?php /*
  <div class="page-header has-right-content fadeIn animated d03s" style="background-image: url(http://smartyschool.stylemixthemes.com/university/wp-content/uploads/2016/09/bg-shop.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12 align-self-center">
          <div class="header-content">
            <p class="title h3 bold text-uppercase">Product</p>
            <p class="mb-lg-0 mb-2">Lorem ipsum dolor sit amet</p>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="right-content text-lg-right">
            <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit Nulla viverra tellus efficitur mau</p>
            <p class="mb-0 smaller-90">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dui turpis, pretium nec velit vitae, dictum mollis metus. Integer ut est quis odio euismod
venenatis et at orci.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="page-header-overlay"></div>
  </div>
  */ ?>
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="<?php echo Yii::$app->request->BaseUrl.'/site/index'; ?>"><?php echo Yii::t('common', 'Home');?></a></li>
            <li class="breadcrumb-item active"><?php echo Yii::t('common', 'Product');?></li>
        </ol>
    </nav>
    <div class="row fadeIn animated d03s mt-3 mb-4">
        <?php foreach ($product_categories as $product_category) { ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card dc-card mb-4 corner-0 z-shadow fadeIn animated d03s">
                <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-list?id=<?= $product_category->id; ?>" class="hover-box">
                    <div class="img-16by9 holder">
                        <img class="card-img-top img-responsive corner-0"
                                src="<?php echo Yii::$app->request->BaseUrl; ?>/backend/uploads/product_type/<?= $product_category->main_photo; ?>">
                    </div>
                </a>
                <div class="card-body text-center">
                    <a href="<?php echo Yii::$app->request->BaseUrl; ?>/site/product-list?id=<?= $product_category->id; ?>"
                        class="card-title font-weight-normal bigger-110 my-0 block"><?= $product_category->name;?></a>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
    <?php /*
    <div class="row fadeIn animated d03s mt-3 mb-4">
        <?php foreach ($product_categories as $product_category) { ?>
            <div class="col-md-4 col-12">
                <a href="product-list?id=<?= $product_category->id; ?>&c=all" class="block mb-3">
                    <div class="media-wrapper corner-1">
                        <div class="img-16by9 holder corner-1">
                            <img class="card-img-top img-responsive" src="/backend/uploads/product_type/<?= $product_category->main_photo; ?>">
                        </div>
                        <p class="mb-0 bigger-120 font-weight-normal center bold"><?= $product_category->name;?></p>
                        <div class="media-overlay corner-1"></div>
                    </div>
                </a>
            </div>

        <?php } ?>
        <div class="clearfix"></div>
    </div>
    */ ?>
</div>
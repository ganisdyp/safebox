<?php

use frontend\models\DC;
use common\models\BlogSearch;
use common\models\ProductTypeSearch;

/* @var $this yii\web\View */
/* Yii::$app->db->open();*/
$this->title = Yii::t('common', 'Home');
$searchModel = new BlogSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
define('PAGE_NAME', 'index');

$product_category = DC::get_menu_product();
// echo '<pre>';
// print_r($product_category);
// echo '</pre>';
?>
<div id="index-page">
  <div class="fadeIn animated d05s">
    <div id="carouselHero" class="carousel slide" data-ride="carousel" data-interval="8000">
      <ol class="carousel-indicators">
        <li data-target="#carouselHero" data-slide-to="0" class="active"></li>
        <li data-target="#carouselHero" data-slide-to="1"></li>
        <li data-target="#carouselHero" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="../images/home/Safe-Box-Asia.jpg">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../images/home/Safe-Box-Asia-Table.jpg">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../images/home/Falcon-Safebox.jpg">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselHero" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselHero" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-4 text-lg-right text-center">
        <img src="../images/home/ss1-to-5-ndt-6-1.png" class="img-fluid" alt="safebox thailand">
      </div>
      <div class="col-lg-8 mt-lg-0 mt-4">
        <span class="product-tag bg-blue-light viewpoint-animate d03s" data-animation="fadeInDown"><?php echo Yii::t('common', 'tag_highq'); ?></span>
        <h2 class="page-title my-3 viewpoint-animate d03s" data-animation="fadeInDown"><?php echo Yii::t('common', 'site_name'); ?></h2>
        <div class="product-detail mt-4 mb-lg-4 mb-3 viewpoint-animate d03s" data-animation="fadeIn">
          <?php 
            echo '<p>'.Yii::t('common', 'content_about_1').'</p>';
            echo '<p>'.Yii::t('common', 'content_about_2').'</p>';
          ?>
        </div>
        <a href="product-detail.php" class="btn btn-primary"><?php echo Yii::t('common', 'more'); ?></a>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row py-5">
    <div class="col-12 mb-3">
      <div class="section-title text-center mt-3 viewpoint-animate d03s" data-animation="fadeIn">
        <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'our_product'); ?></h2>
        <hr class="mx-auto">
      </div>
    </div>
    <?php for ($i = 0; $i < count($product_category); $i++) {
      $product_c = $product_category[$i];
      // print_r($product_c);
      ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="<?php echo $product_c['link']; ?>">
          <div class="card card-event">
            <div class="card-image pos-rel">
              <div class="img-4by3 holder">
                <img class="card-img-top img-fluid" src="../images/home/p-regalia-safebox.jpg">
              </div>
            </div>
            <div class="card-body text-center py-0">
              <div class="card-title bold"><?php echo $product_c['text']; ?></div>
            </div>
          </div>
        </a>
      </div>
    <?php } ?>
  </div>
</div>
<div class="bg-blue-dark">
  <div class="container py-4">
    <div class="row justify-content-between">
      <div class="col-12">
        <div class="section-title text-center mt-3 viewpoint-animate d03s" data-animation="fadeIn">
          <h2 class="letter-spacing-1 font-playfair text-white"><?php echo Yii::t('common', 'our_brand'); ?></h2>
          <hr class="mx-auto">
        </div>
      </div>
      <div class="col-md-3 mb-lg-0 mb-3">
        <a href="/site/product-category/">
          <img src="../images/home/logo-regalia-white.png" class="img-fluid" alt="safebox thailand regalia">
        </a>
      </div>
      <div class="col-md-3 mb-lg-0 mb-3">
        <a href="/site/product-category/">
          <img src="../images/home/logo-falcon-safe.png" class="img-fluid" alt="safebox thailand falcon">
        </a>
      </div>
      <div class="col-md-3 mb-lg-0 mb-3">
        <a href="/site/product-category/">
          <img src="../images/home/logo-lion-steelworks.png" class="img-fluid" alt="safebox thailand lion steelworks">
        </a>
      </div>
    </div>
  </div>
</div>
<div class="container my-4">
  <div class="row align-items-center">
    <div class="col-6 mb-4">
      <div class="section-title mt-3 viewpoint-animate d03s" data-animation="fadeIn">
        <h2 class="letter-spacing-1 font-playfair"><?php echo Yii::t('common', 'Blog'); ?></h2>
        <hr>
      </div>
    </div>
    <div class="col-6 text-right">
      <a href="<?php echo Yii::$app->request->BaseUrl.'/site/blog-category'; ?>" class="btn btn-primary"><?php echo Yii::t('common', 'AllBlogs'); ?></a>
    </div>
  </div>
  <div class="row">
    <?php for ($i = 0; $i < 3; $i++) { ?>
    <div class="col-lg-4 col-md-6 mb-lg-0 mb-4 viewpoint-animate d03s" data-animation="fadeIn">
      <a href="blog-detail.php">
        <div class="card card-event">
          <div class="card-image pos-rel">
            <div class="img-4by3 holder">
              <img class="card-img-top img-fluid" src="images/events/01.jpg">
            </div>
          </div>
          <div class="card-body">
            <div class="card-datetime smaller-90">12 Sep 2019</div>
            <div class="card-title bold">RFP 5200 Series</div>
            <div class="card-detail">
              Duis aute irure dolor in reprehenderit in voluptate velit eu fugiat nulla pariatur.
            </div>
            <div class="text-center mt-4">
              <div class="btn btn-outline-dark btn-block px-5"><?php echo Yii::t('common', 'read_more'); ?></div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <?php } ?>
  </div>
</div>

<?php /*
<div class="container">
  <div class="row mt-4 mb-lg-3 mb-0">
    <!-- start Blogs -->
    <div class="col-lg-4 col-12 mt-lg-0 mt-4">
      <div id="fieldtrip" class="main-section">
        <div class="list-group viewpoint-animate d03s z-shadow" data-animation="fadeInRight">
          <a href="fieldtrip.php" class="list-group-item list-group-item-action flex-column align-items-start py-1 active corner-0">
            <div class="d-flex w-100 justify-content-between">
              <p class="my-1 text-uppercase"><?php echo Yii::t('common', 'Blog');?></p>
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
                      <img class="img-responsive corner-0" src="/backend/uploads/blog/<?= $blog->main_photo; ?>">
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
            <a href="/site/blog-category" class="smaller-90 py-2 block"><?php echo Yii::t('common', 'AllBlogs');?> <i class="fa fa-angle-right ml-1"></i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- end Blogs -->
  </div>
</div>
*/ ?>
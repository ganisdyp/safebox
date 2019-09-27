<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('common', 'About');
$this->params['breadcrumbs'][] = $this->title;
define('PAGE_NAME', 'about');
?>
<div class="navbar-main-hero image-section overlay pos-rel py-5">
  <div class="container">
    <div class="row mt-lg-5 mt-3 justify-content-center">
      <div class="col-12 my-lg-5 my-md-5 my-0 py-lg-4 py-0"></div>
      <div class="col-12">
        <div class="d03s fadeInDown animated" data-animation="fadeInDown">
          <p class="h2 mt-5 font-playfair letter-spacing-2 text-uppercase text-brown-dark">Safe Box Thailand</p>
        </div>
      </div>
      <div class="col-lg-6 mt-3 pb-3">
        <div class="d03s fadeIn animated" data-animation="fadeIn">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="about-page" class="container">
  <div class="row align-items-center my-lg-5 my-4">
    <div class="col-lg-7 col-md-8">
      <div class="section-title viewpoint-animate d03s" data-animation="fadeInDown">
        <h2 class="letter-spacing-1 font-playfair">About Safe Box Thailand</h2>
        <hr>
      </div>
      <div>
        <p>Safe Box Asia is a new company that aims at providing high quality safes and technical services to it's clients. Safe Box Asia has began operations on Jan 1, 2018. We will also be a one stop office solution to your business by providing a full comprehensive range of Office Equipment, Office Supplies, Toners & Inks, Business Machines, Office Furniture, Repair Safebox, Force Open Safebox, Safebox Relocation, Safebox Key Duplication</p>
        <p>We supply to various businesses, schools & other big & small organizations. No matter who you are or what is your needs & requirements you will receive our dedicated customer service & care. We have a group of dedicated team with a vast wealth of knowledge to service you. Last but not least, we aim to be competitive in offering you products which are value for money.</p>
      </div>
    </div>
    <div class="col-lg-5 col-md-4 text-center mt-lg-0 mt-3">
      <img src="https://via.placeholder.com/300x300" class="img-fluid" alt="">
    </div>
  </div>
</div>
<div id="section-about-point" class="image-section overlay text-white">
  <div class="container">
    <div class="row py-5 align-items-center">
      <div class="col-lg-6 mb-lg-0 mb-3">
        <div class="section-title">
          <h2 class="letter-spacing-1 font-playfair">NEED A QUOTE?</h2>
        </div>
      </div>
      <div class="col-lg-6 text-lg-right text-center"><a href="contact.php" class="btn btn-outline-light">CONTACT US</a></div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row align-items-center my-5 py-lg-3 py-2">
    <div class="col-lg-6 col-md-4 text-center order-md-1 order-2 mt-md-0 mt-4">
      <img src="https://via.placeholder.com/300x300" class="img-fluid" alt="">
    </div>
    <div class="col-lg-6 col-md-8 order-md-2 order-1 text-center">
      <div class="section-title">
        <h2 class="letter-spacing-1 font-playfair">Vision</h2>
        <hr class="mx-auto">
      </div>
      <div class="mt-4">
        <p>To be a trusted supplier of office supplies and equipment for individuals, small enterprises, and corporate.</p>
      </div>
    </div>
  </div>
  <div class="row align-items-center my-5 py-lg-3 py-2">
    <div class="col-lg-6 col-md-4 text-center order-md-2 order-1 mt-md-0 mt-4">
      <img src="https://via.placeholder.com/300x300" class="img-fluid" alt="">
    </div>
    <div class="col-lg-6 col-md-8 order-md-1 order-2 text-center">
      <div class="section-title">
        <h2 class="letter-spacing-1 font-playfair">Mission</h2>
        <hr class="mx-auto">
      </div>
      <div class="mt-4">
        <p>Provide our customers with good service and good quality goods that will suit their individual needs, as well as excellent after-sales service.</p>
      </div>  
    </div>
  </div>
</div>
<div id="section-about-point">
  <div class="container">
    <div class="row py-5">
      <div class="col-12">
        <div class="section-title text-center mt-3">
          <span class="product-tag bg-blue-light">unique selling point</span>
          <h2 class="letter-spacing-1 font-playfair mt-3">Why Choose Us?</h2>
          <hr class="mx-auto">
        </div>
      </div>
      <div class="col-md-4 text-center mt-4 good-point viewpoint-animate d03s" data-animation="fadeIn">
        <div class="good-icon shadow">
          <img src="images/icons/heart-outline.svg" height="54px;">
        </div>
        <p class="text-uppercase bold bigger-110 my-3">Good Points</p>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit eu fugiat nulla pariatur.</p>
      </div>
      <div class="col-md-4 text-center mt-4 good-point viewpoint-animate d03s" data-animation="fadeIn">
        <div class="good-icon shadow">
          <img src="images/icons/shopping-bag-outline.svg" height="54px;">
        </div>
        <p class="text-uppercase bold bigger-110 my-3">Good Points</p>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit eu fugiat nulla pariatur.</p>
      </div>
      <div class="col-md-4 text-center mt-4 good-point viewpoint-animate d03s" data-animation="fadeIn">
        <div class="good-icon shadow">
          <img src="images/icons/shield-outline.svg" height="54px;">
        </div>
        <p class="text-uppercase bold bigger-110 my-3">Good Points</p>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit eu fugiat nulla pariatur.</p>
      </div>
    </div>
  </div>
</div>
<?php /*
<div class="row mt-3 mb-5">
  <div class="col-lg-8 col-12 d-flex align-items-start flex-column fadeIn animated d1s">
    <p class="bigger-130 text-purple mb-3 line-height-150 d03s fadeInDown animated" data-animation="fadeInDown"><?php echo Yii::t('common', 'About_Title'); ?></p>
    <div class="font-chatthai">
      <p><?php echo Yii::t('common', 'About_Content'); ?></p>
      <p>
        <?php echo Yii::t('common', 'About_Contact_1_1'); ?>
        <a href="http://disayachudasri.academia.edu/" class="mr-1 ml-1"><?php echo Yii::t('common', 'About_Contact_1_2'); ?></a>
        <?php echo Yii::t('common', 'About_Contact_1_3'); ?>
        <a href="https://chiangmai.academia.edu/DisayaChudasri" class="ml-1">Academia.edu</a>
      </p>
    </div>
    <div class="mt-lg-5 mt-4">
        <a href="/site/contact" class=""><?php echo Yii::t('common', 'About_Contact_2'); ?> <i class="fa fa-angle-right ml-1"></i></a>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
*/ ?>
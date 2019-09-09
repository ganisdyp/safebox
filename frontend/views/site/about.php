<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('common', 'About');
$this->params['breadcrumbs'][] = $this->title;
define('PAGE_NAME', 'about');
?>
<div id="about-page" class="container">
    <nav class="mt-2 fadeIn animated d07s">
        <ol class="breadcrumb smaller-90">
            <li class="breadcrumb-item"><a href="/site/index"><?php echo Yii::t('common', 'Home');;?></a></li>
            <li class="breadcrumb-item active"><?php echo Yii::t('common', 'About');;?></li>
        </ol>
    </nav>
    <div class="row mt-3 mb-5">
        <div class="col-lg-4 col-12 mb-2">
            <a href="../images/about.jpg" data-lightbox="true">
                <div class="img-4by3-v holder viewpoint-animate d03s" data-animation="fadeInDown">
                    <img class="img-responsive corner-0" src="../images/about.jpg">
                </div>
            </a>
        </div>
        <div class="col-lg-8 col-12 d-flex align-items-start flex-column fadeIn animated d1s">
            <p class="bigger-130 text-purple mb-3 line-height-150 d03s fadeInDown animated" data-animation="fadeInDown"><?php echo Yii::t('common', 'About_Title'); ?></p>
            <div class="font-chatthai">
                <p><?php echo Yii::t('common', 'About_Content'); ?>
                </p>
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
</div>
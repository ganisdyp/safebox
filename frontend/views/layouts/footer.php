<?php
use frontend\models\DC;
$menu_list = DC::get_menu();

echo '</div>';
?>
<footer>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 order-md-1 order-2 text-lg-left text-center my-2">
        <img src="../images/logo.png" height="67px;" alt="safebox thailand">
      </div>
      <div class="col-md-6 order-md-2 order-1 text-lg-right text-center my-2">
        <div class="social">
          <a href="#" class="fa-stack mx-1" style="vertical-align: top;">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-facebook-f fa-stack-1x fa-inverse"></i>
          </a>
          <a href="#" class="fa-stack mx-1" style="vertical-align: top;">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
          </a>
          <a href="#" class="fa-stack mx-1" style="vertical-align: top;">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'Product'); ?></p>
        <ul class="footer-nav nav flex-column align-items-start">
          <li class="nav-item"><a href="#" class="nav-link">Regalia Safebox</a></li>
        </ul>
      </div>
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'site_map'); ?></p>
        <ul class="footer-nav nav flex-column align-items-start">
        <?php foreach ($menu_list as $menu) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $menu['link']; ?>"><?php echo $menu['text']; ?></a>
          </li>
        <?php } ?>
        </ul>
      </div>
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'Latest Blogs'); ?></p>
        <ul class="footer-nav nav flex-column align-items-start">
          <li class="nav-item"><a href="#" class="nav-link">Blog 1</a></li>
        </ul>
      </div>
      <div class="col-md-3 smaller-90 my-2">
        <p class="text-uppercase bigger-120 mb-2"><?php echo Yii::t('common', 'Contact'); ?></p>
        <div class="d-flex my-1">
          <img src="../images/icons/pin-outline.svg" height="24px" class="mr-1">
          <div>
            Safe Box Thailand
            <div class="smaller-90"><?php echo Yii::t('common', 'address_content_1'); ?></div>
            <div class="smaller-90"><?php echo Yii::t('common', 'address_content_2'); ?></div>
          </div>
        </div>
        <div class="d-flex my-2">
          <img src="../images/icons/phone-outline.svg" height="24px" class="mr-1">
          <div>089-9999999</div>
        </div>
        <div class="d-flex my-1">
          <img src="../images/icons/email-outline.svg" height="24px" class="mr-1">
          <div>email@gmail.com</div>
        </div>
      </div>
      <div class="col-12">
        <hr class="mt-1">
        <div class="d-flex justify-content-between text-gray smaller-80">
          <p><?php echo Yii::t('common', 'Allright'); ?></p>
        </div>
      </div>
    </div>
  </div>
</footer>
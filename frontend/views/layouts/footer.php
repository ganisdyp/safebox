<?php
use frontend\models\DC;
use frontend\models\System;

$menu_list = DC::get_menu();
?>
<button class="btn-to-top" title="Go to top" style="width:50px;height:50px;">
    <i class="fa fa-angle-double-up"></i>
</button>
</div>

<footer class="dc-shadow">
    <div class="container">
        <?php /*
        <div class="row smaller-90">
            <div class="col-lg-4 col-12 mb-2">
                <p class="mb-0">College of Arts, Media and Technology</p>
                <p class="mb-0">Chiang Mai University</p>
                <p class="mb-0">239 Huaykaew Road, Suthep, Muang,</p>
                <p class="mb-0">Chiang Mai, Thailand 50200</p>
                <p class="mt-3 mb-0">Tel. 053-920299 Fax. 053-941803</p>
            </div>
            <div class="col-lg-8 col-12 text-lg-right">
                <ul class="footer-menu smaller-90">
                    <?php foreach ($menu_list as $menu) { ?>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="<?php echo $menu['link'];?>"><?php echo $menu['text'];?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        */ ?>
        <div class="row">
            <div class="col-lg-6 col-12 font-chatthai smaller-90"><?php echo Yii::t('common', 'Allright'); ?></div>
            <div class="col-lg-6 col-12 text-lg-right"><a href="/site/contact"><?php echo Yii::t('common', 'Contact Us'); ?></a></div>
        </div>
    </div>
</footer>

<?php
echo '</div>';
?>
<?php
use frontend\models\DC;
use frontend\models\System;
//use common\components\LanguageDropdown;
use yii\helpers\Url;
use yii\helpers\Html;
$menu_list = DC::get_menu();
System::debug_control();

// generate menu
$left_menu = array();
$right_menu = array();
foreach ($menu_list as $menu) {
    $active = (PAGE_NAME == $menu['pagename']) ? 'active' : '';
    $is_subpage = (isset($menu['subpage'])) ? 'dropdown' : '';
    $menu_html = '<li class="nav-item '.$active.' '.$is_subpage.'">';

    if(isset($menu['subpage'])) {
        $subpage_list = $menu['subpage'];
        $menu_html .= '<a class="nav-link dropdown-toggle" href="'.$menu['link'].'" id="'.$menu['text'].'" role="button" aria-haspopup="true" aria-expanded="false">'.$menu['text'].'</a>';

        $menu_html .= '<div class="dropdown-menu" aria-labelledby="'.$menu['text'].'">';
        foreach ($subpage_list as $subpage) {
            $menu_html .= '<a class="dropdown-item" href="'.$subpage['link'].'">'.$subpage['text'].'</a>';
        }
        $menu_html .= '</div>';
    } else {
        $menu_html .= '<a class="nav-link position-relative" href="'.$menu['link'].'">'.$menu['text'].'</a></li>';
    }

    if(isset($menu['right']) && $menu['right'] == true) {
        array_push($right_menu, $menu_html);
    } else {
        array_push($left_menu, $menu_html);
    }
} ?>
<!--<div class="language-bar">
                        <?php
/*                        echo Html::a('TH', Url::current(['language' => 'th-TH']), ['class' => 'nav-link '.(Yii::$app->request->cookies['language']=='th-TH' ? 'active' : '')]);
                        echo Html::a('EN', Url::current(['language' => 'en-US']), ['class' => 'nav-link '.(Yii::$app->request->cookies['language']=='en-US' ? 'active' : '')]);
                        */?>
</div>-->
<?php
$menu_html = '<li class="nav-item">'.Html::a('TH', Url::current(['language' => 'th-TH']), ['class' => 'nav-link '.(Yii::$app->request->cookies['language']=='th-TH' ? 'active' : '')]);
array_push($right_menu, $menu_html);
$menu_html = '<li class="nav-item">'.Html::a('EN', Url::current(['language' => 'en-UK']), ['class' => 'nav-link '.(Yii::$app->request->cookies['language']=='en-UK' ? 'active' : '')]);
array_push($right_menu, $menu_html);
//echo languageDropdown::widget();
$menu_html = '';

if(count($left_menu) > 0) {
    $left_menu = '<ul class="navbar-nav">'.implode('', $left_menu).'</ul>';
} else {
    $left_menu = '';
}
if(count($right_menu) > 0) {
    $right_menu = '<ul class="navbar-nav ml-auto">'.implode('', $right_menu).'</ul>';
} else {
    $right_menu = '';
}

echo '<div class="content">';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-navbar-custom shadow-1">
    <div class="container">
        <?php /*
        <a href="/" class="navbar-brand">
            <div class="">
                <div class="mb-0 h3 bold inline mr-1">DC CMU</div>
                <div class="smaller-50 d-md-inline-block d-none">
                    <p class="mb-0">explorations in design blog</p>
                    <p class="mb-0">and active learning in higher education</p>
                </div>
                <img src="images/logo.png" height="45px" class="mr-2">
            </div>
        </a>
        */ ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#buttom_navbar" aria-controls="buttom_navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="buttom_navbar">
            <?php echo $left_menu.$right_menu;?>
        </div>
    </div>
</nav>
<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use common\models\CourseSearch;
use common\models\ShowcaseTypeSearch;
use common\models\ActivityTypeSearch;

class DC extends Model {
    public static function get_menu() {
        $menu = array(
            array(
                'text' => Yii::t('common', 'Home'),
                'link' => '/site/index',
                'pagename' => 'index',
            ),
            array(
                'text' => Yii::t('common', 'About'),
                'link' => '/site/about',
                'pagename' => 'about',
            ),
            array(
                'text' => Yii::t('common', 'Courses'),
                'link' => '/site/course',
                'pagename' => 'course',
                'subpage' => self::get_menu_courses(),
            ),
            array(
                'text' => Yii::t('common', 'Design Showcase'),
                'link' => '/site/showcase-category',
                'pagename' => 'showcase',
                'subpage' => self::get_menu_showcase(),
            ),
            array(
                'text' => Yii::t('common', 'Study Trips'),
                'link' => '/site/studytrip-category',
                'pagename' => 'studytrip',
                'subpage' => self::get_menu_studytrips(),
            ),
            array(
                'text' => Yii::t('common', 'Contact'),
                'link' => '/site/contact',
                'pagename' => 'contact',
            )
        );

        return $menu;
    }

    public static function get_menu_courses() {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $courses = $dataProvider->query->where([])->orderBy(['code'=>SORT_ASC])->all();
        $menu = array();
        foreach($courses as $course){
            $arr_detail = array(
                'text' => $course->name,
                'code' => $course->code,
                'link' => '/site/course-view?c='.$course->id,
                'pagename' => 'course'
            );
            array_push($menu,$arr_detail);
        }

        return $menu;
    }

    public static function get_menu_showcase() {
        $searchModel = new ShowcaseTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $showcase_category = $dataProvider->query->all();
        $menu = array();
        foreach($showcase_category as $category){
            $arr_detail = array(
                'text' => $category->name,
                'link' => '/site/showcase-list?id='.$category->id.'&c=all',
                'pagename' => 'showcase'
            );
            array_push($menu,$arr_detail);
        }
        
        return $menu;
    }

    public static function get_menu_studytrips() {
        $searchModel = new ActivityTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $studytrip = $dataProvider->query->all();
        $menu = array();
        foreach($studytrip as $trip){
            $arr_detail = array(
                'text' => $trip->name,
                'link' => '/site/studytrip-list?id='.$trip->id.'&c=all',
                'pagename' => 'studytrip'
            );
            array_push($menu,$arr_detail);
        }

        return $menu;
    }

}
?>
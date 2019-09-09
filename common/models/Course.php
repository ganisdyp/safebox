<?php

namespace common\models;

use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property string $code
 * @property string $main_photo
 *
 * @property Activity[] $activities
 * @property CourseLang[] $courseLangs
 * @property Showcase[] $showcases
 */
class Course extends \yii\db\ActiveRecord
{
    public $main_photo_file;
    public function behaviors()
    {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => [
                    'th' => 'Thai',
                    'en' => 'English',
                ],
                'requireTranslations' => true,
                'langClassName' => CourseLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'course_id',
                'tableName' => "{{%course_lang}}",
                'attributes' => ['name', 'description']

            ],
          //  TimestampBehavior::className(),
          //  BlameableBehavior::className(),
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['code','name','description'], 'required'],
            [['code'], 'string', 'max' => 45],
            [['main_photo','name'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['description'], 'string'],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'id' => Yii::t('common', 'ID'),
            'code' => Yii::t('common', 'Code'),
            'main_photo' => Yii::t('common', 'Main Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseLangs()
    {
        return $this->hasMany(CourseLang::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcases()
    {
        return $this->hasMany(Showcase::className(), ['course_id' => 'id']);
    }

    public function getCoursePhotos()
    {
        return $this->hasMany(CoursePhoto::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['course_id' => 'id']);
    }
}

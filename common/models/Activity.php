<?php

namespace common\models;

use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property int $activity_type_id
 * @property string $date_published
 * @property string $main_photo
 * @property int $course_id
 *
 * @property ActivityType $activityType
 * @property ActivityLang[] $activityLangs
 * @property ActivityPhoto[] $activityPhotos
 */
class Activity extends \yii\db\ActiveRecord
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
                'langClassName' => ActivityLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'activity_id',
                'tableName' => "{{%activity_lang}}",
                'attributes' => ['headline', 'description','location']

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
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_type_id','headline','description','location','participant','date_visited','course_id'], 'required'],
            [['activity_type_id','participant','media_type','course_id'], 'integer'],
            [['date_published','date_visited'], 'safe'],
            [['main_photo'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['activity_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ActivityType::className(), 'targetAttribute' => ['activity_type_id' => 'id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'activity_type_id' => Yii::t('common', 'Activity Type ID'),
            'date_published' => Yii::t('common', 'Date Published'),
            'main_photo' => Yii::t('common', 'Main Photo'),
            'course_id' =>  Yii::t('common', 'Course ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityType()
    {
        return $this->hasOne(ActivityType::className(), ['id' => 'activity_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityLangs()
    {
        return $this->hasMany(ActivityLang::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityPhotos()
    {
        return $this->hasMany(ActivityPhoto::className(), ['activity_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
}

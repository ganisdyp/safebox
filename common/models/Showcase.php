<?php

namespace common\models;

use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * This is the model class for table "showcase".
 *
 * @property int $id
 * @property int $course_id
 * @property int $showcase_type_id
 * @property string $date_published
 * @property string $main_photo
 * @property string $keyword
 * @property int $technique_id
 * @property int $media_type
 * @property string $from_date
 * @property string $to_date
 *
 * @property Course $course
 * @property ShowcaseType $showcaseType
 * @property Technique $technique
 * @property ShowcaseLang[] $showcaseLangs
 * @property ShowcaseOwner[] $showcaseOwners
 * @property ShowcaseProfile[] $showcaseProfiles
 */
class Showcase extends \yii\db\ActiveRecord
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
                'langClassName' => ShowcaseLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'showcase_id',
                'tableName' => "{{%showcase_lang}}",
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
        return 'showcase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'showcase_type_id', 'technique_id','name', 'description'], 'required'],
            [['course_id', 'showcase_type_id', 'technique_id','media_type'], 'integer'],
            [['date_published'], 'safe'],
            [['keyword','description'], 'string'],
            [['main_photo', 'from_date', 'to_date','name'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['showcase_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShowcaseType::className(), 'targetAttribute' => ['showcase_type_id' => 'id']],
            [['technique_id'], 'exist', 'skipOnError' => true, 'targetClass' => Technique::className(), 'targetAttribute' => ['technique_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'course_id' => Yii::t('common', 'Course ID'),
            'showcase_type_id' => Yii::t('common', 'Showcase Type ID'),
            'date_published' => Yii::t('common', 'Date Published'),
            'main_photo' => Yii::t('common', 'Main Photo'),
            'keyword' => Yii::t('common', 'Keyword'),
            'technique_id' => Yii::t('common', 'Technique ID'),
            'from_date' => Yii::t('common', 'From Date'),
            'to_date' => Yii::t('common', 'To Date'),
            'media_type' => Yii::t('common', 'Media Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcaseType()
    {
        return $this->hasOne(ShowcaseType::className(), ['id' => 'showcase_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnique()
    {
        return $this->hasOne(Technique::className(), ['id' => 'technique_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcaseLangs()
    {
        return $this->hasMany(ShowcaseLang::className(), ['showcase_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcaseOwners()
    {
        return $this->hasMany(ShowcaseOwner::className(), ['showcase_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcaseProfiles()
    {
        return $this->hasMany(ShowcaseProfile::className(), ['showcase_id' => 'id']);
    }
}

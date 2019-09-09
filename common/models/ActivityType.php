<?php

namespace common\models;

use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;

/**
 * This is the model class for table "activity_type".
 *
 * @property int $id
 * @property string $main_photo
 *
 * @property Activity[] $activities
 * @property ActivityTypeLang[] $activityTypeLangs
 */
class ActivityType extends \yii\db\ActiveRecord
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
                'langClassName' => ActivityTypeLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'activity_type_id',
                'tableName' => "{{%activity_type_lang}}",
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
        return 'activity_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'],'required'],
            [['description'],'string'],
            [['main_photo','name'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'main_photo' => Yii::t('common', 'Main Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['activity_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityTypeLangs()
    {
        return $this->hasMany(ActivityTypeLang::className(), ['activity_type_id' => 'id']);
    }
}

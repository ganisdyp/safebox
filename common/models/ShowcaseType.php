<?php

namespace common\models;

use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
use Yii;

/**
 * This is the model class for table "showcase_type".
 *
 * @property int $id
 * @property string $main_photo
 *
 * @property Showcase[] $showcases
 * @property ShowcaseTypeLang[] $showcaseTypeLangs
 */
class ShowcaseType extends \yii\db\ActiveRecord
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
                'langClassName' => ShowcaseTypeLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'showcase_type_id',
                'tableName' => "{{%showcase_type_lang}}",
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
        return 'showcase_type';
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
    public function getShowcases()
    {
        return $this->hasMany(Showcase::className(), ['showcase_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcaseTypeLangs()
    {
        return $this->hasMany(ShowcaseTypeLang::className(), ['showcase_type_id' => 'id']);
    }
}

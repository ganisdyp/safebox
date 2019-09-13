<?php

namespace common\models;

use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;
/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property int $blog_type_id
 * @property string $date_published
 * @property string $main_photo
 * @property int $brand_id
 *
 * @property BlogType $blogType
 * @property BlogLang[] $blogLangs
 * @property BlogPhoto[] $blogPhotos
 */
class Blog extends \yii\db\ActiveRecord
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
                'langClassName' => BlogLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'blog_id',
                'tableName' => "{{%blog_lang}}",
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
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_type_id','headline','description','location','participant','date_visited','brand_id'], 'required'],
            [['blog_type_id','participant','media_type','brand_id'], 'integer'],
            [['date_published','date_visited'], 'safe'],
            [['main_photo'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['blog_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogType::className(), 'targetAttribute' => ['blog_type_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'blog_type_id' => Yii::t('common', 'Blog Type ID'),
            'date_published' => Yii::t('common', 'Date Published'),
            'main_photo' => Yii::t('common', 'Main Photo'),
            'brand_id' =>  Yii::t('common', 'Brand ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogType()
    {
        return $this->hasOne(BlogType::className(), ['id' => 'blog_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogLangs()
    {
        return $this->hasMany(BlogLang::className(), ['blog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPhotos()
    {
        return $this->hasMany(BlogPhoto::className(), ['blog_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }
}

<?php

namespace common\models;

use Yii;
use omgdef\multilingual\MultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $brand_id
 * @property int $product_type_id
 * @property string $date_published
 * @property string $main_photo
 * @property string $keyword
 * @property int $subcategory_id
 * @property int $media_type
 * @property string $from_date
 * @property string $to_date
 *
 * @property Brand $brand
 * @property ProductType $productType
 * @property Subcategory $technique
 * @property ProductLang[] $productLangs
 * @property ProductOwner[] $productOwners
 * @property ProductPhoto[] $productPhotos
 */
class Product extends \yii\db\ActiveRecord
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
                'langClassName' => ProductLang::className(),
                'defaultLanguage' => 'en',
                'langForeignKey' => 'product_id',
                'tableName' => "{{%product_lang}}",
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
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'product_type_id', 'subcategory_id','name', 'description'], 'required'],
            [['brand_id', 'product_type_id', 'subcategory_id','media_type'], 'integer'],
            [['date_published'], 'safe'],
            [['keyword','description'], 'string'],
            [['main_photo', 'name'], 'string', 'max' => 100],
            [['main_photo_file'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id']],
            [['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcategory_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'brand_id' => Yii::t('common', 'Brand ID'),
            'product_type_id' => Yii::t('common', 'Product Type ID'),
            'date_published' => Yii::t('common', 'Date Published'),
            'main_photo' => Yii::t('common', 'Main Photo'),
            'keyword' => Yii::t('common', 'Keyword'),
            'subcategory_id' => Yii::t('common', 'Subcategory ID'),
            'media_type' => Yii::t('common', 'Media Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductLangs()
    {
        return $this->hasMany(ProductLang::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOwners()
    {
        return $this->hasMany(ProductOwner::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPhotos()
    {
        return $this->hasMany(ProductPhoto::className(), ['product_id' => 'id']);
    }
}

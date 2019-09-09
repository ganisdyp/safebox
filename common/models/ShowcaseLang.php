<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "showcase_lang".
 *
 * @property int $id
 * @property int $showcase_id
 * @property string $name
 * @property string $description
 * @property string $language
 *
 * @property Showcase $showcase
 */
class ShowcaseLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'showcase_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['showcase_id', 'name', 'description', 'language'], 'required'],
            [['showcase_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['showcase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Showcase::className(), 'targetAttribute' => ['showcase_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'showcase_id' => Yii::t('common', 'Showcase ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcase()
    {
        return $this->hasOne(Showcase::className(), ['id' => 'showcase_id']);
    }
}

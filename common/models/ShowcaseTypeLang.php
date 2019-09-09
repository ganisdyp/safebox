<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "showcase_type_lang".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $showcase_type_id
 * @property string $language
 *
 * @property ShowcaseType $showcaseType
 */
class ShowcaseTypeLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'showcase_type_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'showcase_type_id', 'language'], 'required'],
            [['description'], 'string'],
            [['showcase_type_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['showcase_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShowcaseType::className(), 'targetAttribute' => ['showcase_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'showcase_type_id' => Yii::t('common', 'Showcase Type ID'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcaseType()
    {
        return $this->hasOne(ShowcaseType::className(), ['id' => 'showcase_type_id']);
    }
}

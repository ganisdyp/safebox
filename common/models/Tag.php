<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "theme".
 *
 * @property int $id
 * @property string $theme_name
 *
 * @property Product[] $products
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['tag'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'tag' => Yii::t('common', 'Tag Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['tag_id' => 'id']);
    }
}

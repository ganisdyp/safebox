<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "theme".
 *
 * @property int $id
 * @property string $theme_name
 *
 * @property Showcase[] $showcases
 */
class Technique extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'technique';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['technique_name'], 'required'],
            [['technique_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'technique_name' => Yii::t('common', 'Technique Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShowcases()
    {
        return $this->hasMany(Showcase::className(), ['technique_id' => 'id']);
    }
}

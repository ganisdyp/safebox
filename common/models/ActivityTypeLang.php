<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_type_lang".
 *
 * @property int $id
 * @property int $activity_type_id
 * @property string $name
 * @property string $description
 * @property string $language
 *
 * @property ActivityType $activityType
 */
class ActivityTypeLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_type_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_type_id', 'name', 'language'], 'required'],
            [['activity_type_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['activity_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ActivityType::className(), 'targetAttribute' => ['activity_type_id' => 'id']],
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
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityType()
    {
        return $this->hasOne(ActivityType::className(), ['id' => 'activity_type_id']);
    }
}

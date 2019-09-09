<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_lang".
 *
 * @property int $id
 * @property int $activity_id
 * @property string $headline
 * @property string $description
 * @property string $language
 *
 * @property Activity $activity
 */
class ActivityLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'headline', 'description', 'language'], 'required'],
            [['activity_id'], 'integer'],
            [['description'], 'string'],
            [['headline'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activity::className(), 'targetAttribute' => ['activity_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'activity_id' => Yii::t('common', 'Activity ID'),
            'headline' => Yii::t('common', 'Headline'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id' => 'activity_id']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_lang".
 *
 * @property int $id
 * @property int $course_id
 * @property string $name
 * @property string $description
 * @property string $language
 *
 * @property Course $course
 */
class CourseLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'name', 'description', 'language'], 'required'],
            [['course_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['language'], 'string', 'max' => 10],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'course_id' => Yii::t('common', 'Course ID'),
            'name' => Yii::t('common', 'Name'),
            'description' => Yii::t('common', 'Description'),
            'language' => Yii::t('common', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
}

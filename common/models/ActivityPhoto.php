<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_photo".
 *
 * @property int $id
 * @property int $activity_id
 * @property string $photo_url
 * @property string $caption
 *
 * @property Activity $activity
 */
class ActivityPhoto extends \yii\db\ActiveRecord
{

    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';
    const SCENARIO_BATCH_UPDATE = 'batchUpdate';
    private $_updateType;
    public $activity_photo;
    public function getUpdateType()
    {
        if (empty($this->_updateType)) {
            if ($this->isNewRecord) {
                $this->_updateType = self::UPDATE_TYPE_CREATE;
            } else {
                $this->_updateType = self::UPDATE_TYPE_UPDATE;
            }
        }
        return $this->_updateType;
    }
    public function setUpdateType($value)
    {
        $this->_updateType = $value;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['updateType', 'required', 'on' => self::SCENARIO_BATCH_UPDATE],
            ['updateType',
                'in',
                'range' => [self::UPDATE_TYPE_CREATE, self::UPDATE_TYPE_UPDATE, self::UPDATE_TYPE_DELETE],
                'on' => self::SCENARIO_BATCH_UPDATE
            ],
            [['activity_id'], 'required','except' => self::SCENARIO_BATCH_UPDATE],
            [['activity_id'], 'integer'],
            [['photo_url'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['photo_url', 'caption'], 'string', 'max' => 100],
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
            'photo_url' => Yii::t('common', 'Photo Url'),
            'caption' => Yii::t('common', 'Caption'),
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

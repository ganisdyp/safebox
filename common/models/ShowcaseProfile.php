<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "showcase_profile".
 *
 * @property int $id
 * @property string $showcase_url
 * @property int $showcase_id
 *
 * @property Showcase $showcase
 */
class ShowcaseProfile extends \yii\db\ActiveRecord
{

    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';
    const SCENARIO_BATCH_UPDATE = 'batchUpdate';
    private $_updateType;
    public $showcase_photo;
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
        return 'showcase_profile';
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
            [['showcase_id'], 'required','except' => self::SCENARIO_BATCH_UPDATE],
            [['showcase_id'], 'integer'],
            [['showcase_photo'],'file','skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['showcase_url'], 'string', 'max' => 100],
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
            'showcase_url' => Yii::t('common', 'Showcase Url'),
            'showcase_id' => Yii::t('common', 'Showcase ID'),
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

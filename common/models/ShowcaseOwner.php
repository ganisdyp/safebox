<?php

namespace common\models;

use Yii;
//use faryshta\base\EnumTrait;

/**
 * This is the model class for table "showcase_owner".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $faculty
 * @property int $showcase_id
 *
 * @property Showcase $showcase
 */
class ShowcaseOwner extends \yii\db\ActiveRecord
{

    const UPDATE_TYPE_CREATE = 'create';
    const UPDATE_TYPE_UPDATE = 'update';
    const UPDATE_TYPE_DELETE = 'delete';
    const SCENARIO_BATCH_UPDATE = 'batchUpdate';
    private $_updateType;
    // public $showcase_photo;





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
        return 'showcase_owner';
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
            [['showcase_id'], 'required', 'except' => self::SCENARIO_BATCH_UPDATE],
            [['first_name', 'last_name', 'faculty', 'student_code'], 'required'],
            [['faculty','student_code'], 'string'],
            [['showcase_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
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
            'first_name' => Yii::t('common', 'First Name'),
            'last_name' => Yii::t('common', 'Last Name'),
            'faculty' => Yii::t('common', 'Faculty'),
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

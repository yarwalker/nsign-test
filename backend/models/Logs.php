<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property integer $id
 * @property string $object
 * @property string $object_name
 * @property string $field
 * @property string $old_value
 * @property string $new_value
 * @property string $updated_at
 * @property integer $updated_by
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object', 'object_name', 'field', 'old_value', 'new_value', 'updated_by'], 'required'],
            [['updated_at'], 'safe'],
            [['updated_by'], 'integer'],
            [['object', 'object_name', 'field'], 'string', 'max' => 100],
            [['old_value', 'new_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object' => 'Object',
            'object_name' => 'Object Name',
            'field' => 'Field',
            'old_value' => 'Old Value',
            'new_value' => 'New Value',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}

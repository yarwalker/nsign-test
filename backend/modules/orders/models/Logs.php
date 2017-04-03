<?php

namespace backend\modules\orders\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\db\Expression;
use common\models\User;

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
class Logs extends ActiveRecord
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
            'object' => 'Объект',
            'object_name' => 'Название',
            'field' => 'Поле',
            'old_value' => 'Старое значение',
            'new_value' => 'Новое значение',
            'updated_at' => 'Дата изменения',
            'updated_by' => 'Кто обновил',
            'updaterName' => 'Кто обновил',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getUpdaterName()
    {
        return $this->updater ? $this->updater->username : '- unknown -';
    }

    public static function add($log_arr)
    {
        $log = new Logs();

        $log->setAttributes($log_arr);
        $log->save();
        unset($log);
    }
}

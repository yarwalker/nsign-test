<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $name
 * @property integer $good_id
 * @property string $customer_fio
 * @property string $customer_phone
 * @property string $comments
 * @property string $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Orders extends ActiveRecord
{
    const EVENT_CHANGE_ORDER = 'log_order_change';

    public function __construct()
    {
        parent::__construct();

        $this->on(Orders::EVENT_CHANGE_ORDER, [\Yii::$app->event_logs, 'logOrderChange']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'good_id', 'customer_fio', 'customer_phone', 'price'], 'required'],
            [['good_id', 'updated_by'], 'integer'],
            ['price', 'double'],
            [['created_at', 'updated_at'], 'safe'],
            [['comments', 'status'], 'string'],
            [['name', 'customer_fio', 'customer_phone'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'good_id' => 'Товар',
            'customer_fio' => 'Имя клиента',
            'customer_phone' => 'Телефон',
            'comments' => 'Комментарий',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'updated_by' => 'Кто обновил',
            'updaterName' => 'Кто обновил',
            'goodName' => 'Товар',
            'price' => 'Цена',
        ];
    }

    public function getNewName()
    {
        $last_order = $this::find()->orderBy(['id' => SORT_DESC])->one();
        return 'Заявка №' . ($last_order ? $last_order->id + 1: '1');
    }

    public function getGood()
    {
        return $this->hasOne(Goods::className(), ['id' => 'good_id']);
    }

    public function getGoodName()
    {
        return $this->good ? $this->good->name : '- нет товара -';
    }

    public function getGoodPrice()
    {
        return $this->good ? $this->good->price : 0.0;
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getUpdaterName()
    {
        return $this->updater ? $this->updater->username : '- unknown -';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if( !$insert )
                $this->trigger(self::EVENT_CHANGE_ORDER);

            return true;
        }
        return false;
    }

}

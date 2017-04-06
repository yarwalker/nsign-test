<?php
namespace common\components;

use yii\base\Component;
use backend\modules\orders\models\Logs;
use common\helpers\OrderHelper;

class EventLogs extends Component {

    public function logOrderChange($event)
    {
        $not_logged_fields = ['updated_by', 'updated_at', 'created_at'];

        $event->sender->updated_by = \Yii::$app->user->getId();

        $object = get_class($event->sender)::tableName();
        $object_name = $event->sender->name;
        $dirties = $event->sender->dirtyAttributes;

        foreach($dirties as $k => $v) {
            $old_value = $event->sender->getOldAttribute($k);

            if( $old_value !== $v && !in_array($k, $not_logged_fields) ) {
                if($k == 'good_id') {
                    $old_value = OrderHelper::getGoodNameByID($old_value);
                    $v = OrderHelper::getGoodNameByID($v);
                }

                Logs::add([
                    'object' => $object,
                    'object_name' => $object_name,
                    'field' => $event->sender->getAttributeLabel($k),
                    'old_value' => (string) $old_value,
                    'new_value' => (string) $v,
                    'updated_by' => \Yii::$app->user->identity->getId()
                ]);
            }

        }
    }



}
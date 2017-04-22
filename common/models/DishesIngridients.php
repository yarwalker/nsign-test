<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dishes_ingridients".
 *
 * @property integer $id
 * @property integer $dish_id
 * @property integer $ingridient_id
 *
 * @property Dishes $dish
 * @property Ingridients $ingridient
 */
class DishesIngridients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dishes_ingridients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dish_id', 'ingridient_id'], 'required'],
            [['dish_id', 'ingridient_id'], 'integer'],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dishes::className(), 'targetAttribute' => ['dish_id' => 'id']],
            [['ingridient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingridients::className(), 'targetAttribute' => ['ingridient_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_id' => 'Dish ID',
            'ingridient_id' => 'Ingridient ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dishes::className(), ['id' => 'dish_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngridient()
    {
        return $this->hasOne(Ingridients::className(), ['id' => 'ingridient_id']);
    }

    public function getImage()
    {
        return $this->ingridient->image;
    }

    public function getName()
    {
        return $this->ingridient->name;
    }

    public static function prepareDishes(array $ingridient_ids, $params_cnt)
    {
        $placeholders = str_repeat('?,', count($ingridient_ids) - 1). '?';
        $query = 'SELECT d.*, fd.cnt, h.id FROM nsign.dishes as d
                  inner join (select di.dish_id, count(*) cnt 
                  from nsign.dishes_ingridients as di 
                 where di.ingridient_id in (' . $placeholders . ') 
                 group by di.dish_id having count(*) > 1) as fd on fd.dish_id = d.id
                 
                left join 
                (SELECT d1.* FROM nsign.dishes as d1 
                left join nsign.dishes_ingridients as di on di.dish_id = d1.id
                left join nsign.ingridients as i on di.ingridient_id = i.id
                where i.state = "Скрыт") as h on h.id = d.id
                where h.id is null
                order by fd.cnt desc';

        $sql = Yii::$app->db->createCommand($query);
        foreach($ingridient_ids as $i => $item){
            $sql->bindValue($i+1, $item);
        }

        $all_dishes = $sql->queryAll();

        $tmp_result = [];

        foreach( $all_dishes as $dish )
            if ($dish['cnt'] == $params_cnt)
                $tmp_result[] = $dish;

        return [$tmp_result, $all_dishes];
    }
}

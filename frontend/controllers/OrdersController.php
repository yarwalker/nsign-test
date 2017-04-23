<?php

namespace frontend\controllers;

use common\models\Dishes;
use common\models\DishesIngridients;
use Yii;
use \yii\web\Controller;
use common\models\Ingridients;
use frontend\models\ChooseDishForm;
use yii\data\ArrayDataProvider;

class OrdersController extends Controller
{
    public function actionIndex()
    {
        $model = new ChooseDishForm();

        $availableIngridientsProvider = new ArrayDataProvider([
            'allModels' => Ingridients::find()->all(),
            'pagination' => false,
        ]);

        if( Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) ) {
            Yii::$app->response->format = 'json';

            $params_cnt = count($model->ingridients);
            $result = [];
            list($tmp_result, $all_dishes) = DishesIngridients::prepareDishes($model->ingridients, $params_cnt);

            if( $tmp_result ) {
                // есть полностью совпадающие ингридиенты
                $dishesProvider = new ArrayDataProvider([
                    'allModels' => $tmp_result,
                    'pagination' => false,
                ]);

                $result = $this->renderAjax('_view_dishes', [
                    'dishesProvider' => $dishesProvider,
                ]);
            } else {
                // нет полностью совпадающих ингридиентов
                $dishesProvider = new ArrayDataProvider([
                    'allModels' => $all_dishes,
                    'pagination' => false,
                ]);

                $result = $this->renderAjax('_view_dishes', [
                    'dishesProvider' => $dishesProvider,
                ]);
            }

            return ['dishes' => $result];
        }

        return $this->render('index', [
            'model' => $model,
            'availableIngridientsProvider' => $availableIngridientsProvider,
        ]);
    }

}

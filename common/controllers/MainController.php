<?php

namespace common\controllers;

use Yii;
use yii\web\Controller;

class MainController extends Controller
{
    /**
     * Удалем картинку у ингридиента
     */
    public function actionDelImage()
    {
        if( Yii::$app->request->isAjax ) {
            if( is_integer((int) Yii::$app->request->post('id')) ) {
                $model = $this->findModel(Yii::$app->request->post('id'));

                $file = $model->image;
                if( unlink(Yii::$app->params['uploadPath'] . $model->image) ) {
                    $model->image = '';
                    $model->save();
                    $msg = ['result' => 'Изображение удалено.'];
                } else {
                    $msg = ['error' => 'Не удалось удалить изображение.'];
                }
            } else {
                $msg = ['error' => 'Параметр должен быть целым числом.'];
            }
        } else {
            // not ajax request
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        echo json_encode($msg);
    }
}
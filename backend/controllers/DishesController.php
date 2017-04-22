<?php

namespace backend\controllers;


use common\models\DishesIngridients;
use Yii;
use common\controllers\MainController;
use common\models\Dishes;
use common\models\DishesSearch;
use common\models\Ingridients;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * DishesController implements the CRUD actions for Dishes model.
 */
class DishesController extends MainController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dishes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dishes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dishes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dishes();
        $upload_path = Yii::$app->params['uploadPath'];

        $availableIngridientsProvider = new ActiveDataProvider([
            'query' => Ingridients::find()->where(['state' => 'Активен']),
            'pagination' => false,
        ]);

        $currentIngridientsProvider = new ArrayDataProvider([
            'allModels' => $model->dishesIngridients
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if( is_writable($upload_path) && $file = UploadedFile::getInstance($model, 'file') ) {
                $arr = explode(".", $file->name);
                $ext = end($arr);

                $file_name = Yii::$app->security->generateRandomString().".{$ext}";
                $path = $upload_path . $file_name;

                if( !$file->saveAs($path) ) {
                    // не удалось сохранить файл
                    $model->addError($file->error);
                    return $this->goBack();
                } else {
                    $model->image = $file_name;
                    $model->save();
                }
            }

            foreach( $model->ingridients as $item ) {
                $dish_ingridient = new DishesIngridients();
                $dish_ingridient->setAttributes([
                    'dish_id' => $model->id,
                    'ingridient_id' => $item,
                ]);

                $dish_ingridient->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'availableIngridientsProvider' => $availableIngridientsProvider,
                'currentIngridientsProvider' => $currentIngridientsProvider,
            ]);
        }
    }

    /**
     * Updates an existing Dishes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $upload_path = Yii::$app->params['uploadPath'];

        $availableIngridientsProvider = new ActiveDataProvider([
            'query' => Ingridients::find()->where(['state' => 'Активен']),
        ]);

        $currentIngridientsProvider = new ArrayDataProvider([
            'allModels' => $model->dishesIngridients
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if( is_writable($upload_path) && $file = UploadedFile::getInstance($model, 'file') ) {
                $arr = explode(".", $file->name);
                $ext = end($arr);

                $file_name = Yii::$app->security->generateRandomString().".{$ext}";
                $path = $upload_path . $file_name;

                if( !$file->saveAs($path) ) {
                    // не удалось сохранить файл
                    $model->addError($file->error);
                    return $this->goBack();
                } else {
                    $model->image = $file_name;
                    $model->save();
                }
            }

            DishesIngridients::deleteAll(['dish_id' => $model->id]);

            foreach( $model->ingridients as $item ) {
                $dish_ingridient = new DishesIngridients();
                $dish_ingridient->setAttributes([
                    'dish_id' => $model->id,
                    'ingridient_id' => $item,
                ]);

                $dish_ingridient->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'availableIngridientsProvider' => $availableIngridientsProvider,
                'currentIngridientsProvider' => $currentIngridientsProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Dishes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dishes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dishes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dishes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

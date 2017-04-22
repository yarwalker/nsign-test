<?php

namespace backend\controllers;

use Yii;
use common\controllers\MainController;
use common\models\Ingridients;
use common\models\IngridientsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * IngridientsController implements the CRUD actions for Ingridients model.
 */
class IngridientsController extends MainController
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
     * Lists all Ingridients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngridientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ingridients model.
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
     * Creates a new Ingridients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ingridients();
        $upload_path = Yii::$app->params['uploadPath'];

        if( $model->load(Yii::$app->request->post()) && $model->save() ) {
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

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ingridients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $upload_path = Yii::$app->params['uploadPath'];

        if( $model->load(Yii::$app->request->post()) && $model->save() ) {
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

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ingridients model.
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
     * Finds the Ingridients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingridients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingridients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}

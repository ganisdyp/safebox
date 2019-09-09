<?php

namespace backend\modules\content\controllers;

use Yii;
use common\models\ShowcaseType;
use backend\modules\content\models\ShowcaseTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ShowcaseTypeController implements the CRUD actions for ShowcaseType model.
 */
class ShowcasetypeController extends Controller
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
     * Lists all ShowcaseType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShowcaseTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShowcaseType model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShowcaseType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShowcaseType();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'main_photo_file');
            if (isset($file->size) && $file->size != 0) {
                //  $model->main_photo = $file->baseName . '.' . $file->extension;
                $unique_name = "showcase-type_" . date("Y-m-d_H-i-s") . "_". uniqid();
                $path = $unique_name . ".{$file->extension}";
                $model->main_photo = $path;
                $file->saveAs('uploads/showcase_type/' . $path);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ShowcaseType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $file = UploadedFile::getInstance($model, 'main_photo_file');

            if (isset($file->size) && $file->size !== 0) {

                $old_name = $model->main_photo;
                $unique_name = "showcase-type_" . date("Y-m-d_H-i-s") . "_". uniqid();
                $path = $unique_name . ".{$file->extension}";
                $model->main_photo = $path;
                $file->saveAs('uploads/showcase_type/' . $path);
                if (isset($old_name)) {
                    unlink('uploads/showcase_type/' . $old_name);
                } else {
                    //Do nothing
                }

                //  $model->main_photo = $file->baseName . '.' . $file->extension;
                //  $file->saveAs('uploads/showcase_type/' . $file->baseName . '.' . $file->extension);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ShowcaseType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $showcasetype_langs = $this->findModel($id)->getShowcaseTypeLangs()->where(['showcase_type_id' => $id])->all();
        foreach ($showcasetype_langs as $showcasetype_lang) {
            $showcasetype_lang->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/showcase_type/' . $this->findModel($id)->main_photo);
        } else {
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ShowcaseType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShowcaseType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShowcaseType::find()->multilingual()->where(['showcase_type.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

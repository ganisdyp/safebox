<?php

namespace backend\modules\content\controllers;

use Yii;
use common\models\ActivityType;
use backend\modules\content\models\ActivityTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ActivityTypeController implements the CRUD actions for ActivityType model.
 */
class ActivitytypeController extends Controller
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
     * Lists all ActivityType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivityTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActivityType model.
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
     * Creates a new ActivityType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActivityType();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'main_photo_file');
            if (isset($file->size) && $file->size !== 0) {
                $unique_name = "studytrip-type_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                $path = $unique_name . ".{$file->extension}";
                $model->main_photo = $path;
                $file->saveAs('uploads/activity_type/' . $path);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ActivityType model.
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
                $unique_name = "studytrip-type_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                $path = $unique_name . ".{$file->extension}";
                $model->main_photo = $path;
                $file->saveAs('uploads/activity_type/' . $path);
                if (isset($old_name)) {
                    unlink('uploads/activity_type/' . $old_name);
                } else {
                    // Do nothing
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing ActivityType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $activitytype_langs = $this->findModel($id)->getActivityTypeLangs()->where(['activity_type_id' => $id])->all();
        foreach ($activitytype_langs as $activitytype_lang) {
            $activitytype_lang->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/activity_type/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActivityType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivityType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivityType::find()->multilingual()->where(['activity_type.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

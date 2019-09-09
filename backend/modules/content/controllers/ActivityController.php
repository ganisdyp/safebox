<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Activity;
use common\models\ActivityPhoto;
use backend\modules\content\models\ActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
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
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
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
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*    public function actionCreate()
        {
            $model = new Activity();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    public function actionCreate()
    {
        $model = new Activity();
        $modelDetails = [];

        $formDetails = Yii::$app->request->post('ActivityPhoto', []);

        //   print_r($formDetails);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new ActivityPhoto(['scenario' => ActivityPhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new ActivityPhoto(['scenario' => ActivityPhoto::SCENARIO_BATCH_UPDATE]);
            return $this->render('create', [
                'model' => $model,
                'modelDetails' => $modelDetails,

            ]);
        }

        if ($model->load(Yii::$app->request->post())) {


            if ($model->validate()) {

                //print_r($model);
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                if (isset($file->size) && $file->size != 0) {
                    $unique_name = "activity_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/activity/' . $path);

                    /* $model->main_photo = $file->baseName . '.' . $file->extension;
                     $file->saveAs('uploads/activity/' . $file->baseName . '.' . $file->extension);*/
                }
                $model->save();
                //  print_r($model);
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'activity_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "activity_" . date("Y-m-d_H-i-s"). "_".uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            //     $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            ${'profile_file' . $c}->saveAs('uploads/activity/related_photo/' . $path);
                        }
                        $modelDetail->activity_id = $model->id;
                        $modelDetail->save();
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelDetails' => $modelDetails,
        ]);
    }
    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  public function actionUpdate($id)
      {
          $model = $this->findModel($id);

          if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['view', 'id' => $model->id]);
          }

          return $this->render('update', [
              'model' => $model,
          ]);
      }*/
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->activityPhotos;
        $formDetails = Yii::$app->request->post('ActivityPhoto', []);

        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != ActivityPhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = ActivityPhoto::findOne(['id' => $formDetail['id'], 'activity_id' => $model->id]);
                $modelDetail->setScenario(ActivityPhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new ActivityPhoto(['scenario' => ActivityPhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }


        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new ActivityPhoto(['scenario' => ActivityPhoto::SCENARIO_BATCH_UPDATE]);
            return $this->render('update', [
                'model' => $model,
                'modelDetails' => $modelDetails,
            ]);
        }


        if ($model->load(Yii::$app->request->post())) {


            if (Model::validateMultiple($modelDetails) && $model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                //print_r($file);
                if (isset($file->size) && $file->size !== 0) {
                    $old_name = $model->main_photo;
                    $unique_name = "activity_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/activity/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/activity/' . $old_name);
                    } else {
                        // Do nothing
                    }
                    /*  $model->main_photo = $file->baseName . '.' . $file->extension;
                      $file->saveAs('uploads/activity/' . $file->baseName . '.' . $file->extension);*/
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == ActivityPhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'activity_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            $old_name = $modelDetail->photo_url;
                            $unique_name = "activity_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/activity/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/activity/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }


                            //    $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //   ${'profile_file' . $c}->saveAs('uploads/activity/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                        }
                        $modelDetail->activity_id = $model->id;
                        $modelDetail->save();
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
            'modelDetails' => $modelDetails,

        ]);

    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $activity_langs = $this->findModel($id)->getActivityLangs()->where(['activity_id' => $id])->all();
        foreach ($activity_langs as $activity_lang) {
            $activity_lang->delete();
        }
        $activity_photos = $this->findModel($id)->getActivityPhotos()->where(['activity_id' => $id])->all();
        foreach ($activity_photos as $activity_photo) {
            unlink('uploads/activity/related_photo/' . $activity_photo->photo_url);
            $activity_photo->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/activity/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);

    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::find()->multilingual()->where(['activity.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

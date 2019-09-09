<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Course;
use common\models\CoursePhoto;
use backend\modules\content\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();
        $modelDetails = [];

        $formDetails = Yii::$app->request->post('CoursePhoto', []);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new CoursePhoto(['scenario' => CoursePhoto::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new CoursePhoto(['scenario' => CoursePhoto::SCENARIO_BATCH_UPDATE]);
            return $this->render('create', [
                'model' => $model,
                'modelDetails' => $modelDetails,

            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                if (isset($file->size) && $file->size !== 0) {
                    $unique_name = "course_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    // $model->main_photo = $file->baseName . '.' . $file->extension;
                    $file->saveAs('uploads/course/' . $path);
                }
                $model->save();
                if (Model::validateMultiple($modelDetails)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'course_photo');

                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $unique_name = "course_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;

                            //     $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            ${'profile_file' . $c}->saveAs('uploads/course/related_photo/' . $path);
                        }
                        $modelDetail->course_id = $model->id;
                        $modelDetail->save();
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }

            /* return $this->redirect(['view', 'id' => $model->id]);*/
        }

        return $this->render('create', [
            'model' => $model,
            'modelDetails' => $modelDetails,
        ]);
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->coursePhotos;
        $formDetails = Yii::$app->request->post('CoursePhoto', []);

        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != CoursePhoto::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = CoursePhoto::findOne(['id' => $formDetail['id'], 'course_id' => $model->id]);
                $modelDetail->setScenario(CoursePhoto::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new CoursePhoto(['scenario' => CoursePhoto::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }
        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new CoursePhoto(['scenario' => CoursePhoto::SCENARIO_BATCH_UPDATE]);
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
                    $unique_name = "course_" . date("Y-m-d_H-i-s") . "_". uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/course/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/course/' . $old_name);
                    } else {
                        // Do nothing
                    }
                    //  $model->main_photo = $file->baseName . '.' . $file->extension;
                    //  $file->saveAs('uploads/course/' . $file->baseName . '.' . $file->extension);
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == CoursePhoto::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'course_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {

                            $old_name = $modelDetail->photo_url;
                            $unique_name = "course_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->photo_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/course/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/course/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                            // $modelDetail->photo_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            // ${'profile_file' . $c}->saveAs('uploads/course/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                        }
                        $modelDetail->course_id = $model->id;
                        $modelDetail->save();
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', ['model' => $model,
            'modelDetails' => $modelDetails,]);
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {


        $course_langs = $this->findModel($id)->getCourseLangs()->where(['course_id' => $id])->all();
        foreach ($course_langs as $course_lang) {
            $course_lang->delete();
        }

        $course_photos = $this->findModel($id)->getCoursePhotos()->where(['course_id' => $id])->all();
        foreach ($course_photos as $course_photo) {
            unlink('uploads/course/related_photo/' . $course_photo->photo_url);
            $course_photo->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/course/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Course::find()->multilingual()->where(['course.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

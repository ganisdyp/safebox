<?php

namespace backend\modules\content\controllers;

use Yii;
use yii\base\Model;
use common\models\Showcase;
use common\models\ShowcaseProfile;
use common\models\ShowcaseOwner;
use backend\modules\content\models\ShowcaseSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ShowcaseController implements the CRUD actions for Showcase model.
 */
class ShowcaseController extends Controller
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
     * Lists all Showcase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShowcaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Showcase model.
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
     * Creates a new Showcase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Showcase();
        $modelDetails = [];
        $modelDetails2 = [];
        $formDetails = Yii::$app->request->post('ShowcaseProfile', []);
        $formDetails2 = Yii::$app->request->post('ShowcaseOwner', []);
        //   print_r($formDetails);
        foreach ($formDetails as $i => $formDetail) {
            $modelDetail = new ShowcaseProfile(['scenario' => ShowcaseProfile::SCENARIO_BATCH_UPDATE]);
            $modelDetail->setAttributes($formDetail);
            $modelDetails[] = $modelDetail;
        }
        foreach ($formDetails2 as $i => $formDetail2) {
            $modelDetail2 = new ShowcaseOwner(['scenario' => ShowcaseOwner::SCENARIO_BATCH_UPDATE]);
            $modelDetail2->setAttributes($formDetail2);
            $modelDetails2[] = $modelDetail2;
        }
        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails[] = new ShowcaseProfile(['scenario' => ShowcaseProfile::SCENARIO_BATCH_UPDATE]);
            return $this->render('create', [
                'model' => $model,
                'modelDetails' => $modelDetails,
                'modelDetails2' => $modelDetails2,
            ]);
        }
        if (Yii::$app->request->post('addRowOwner') == 'true') {
            $model->load(Yii::$app->request->post());
            $modelDetails2[] = new ShowcaseOwner(['scenario' => ShowcaseOwner::SCENARIO_BATCH_UPDATE]);
            return $this->render('create', [
                'model' => $model,
                'modelDetails' => $modelDetails,
                'modelDetails2' => $modelDetails2,
            ]);
        }
        if ($model->load(Yii::$app->request->post())) {


            if ($model->validate()) {

                //print_r($model);
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                if (isset($file->size) && $file->size != 0) {
                    /* $model->main_photo = $file->baseName . '.' . $file->extension;
                     $file->saveAs('uploads/showcase/' . $file->baseName . '.' . $file->extension);*/

                    $unique_name = "showcase_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/showcase/' . $path);
                }
                $model->save();
                //  print_r($model);
                if (Model::validateMultiple($modelDetails) && Model::validateMultiple($modelDetails2)) {


                    foreach ($modelDetails as $c => $modelDetail) {

                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'showcase_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            //  $modelDetail->showcase_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //  ${'profile_file' . $c}->saveAs('uploads/showcase/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);

                            $unique_name = "showcase_" . date("Y-m-d_H-i-s") . "_". uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->showcase_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/showcase/related_photo/' . $path);

                        }
                        $modelDetail->showcase_id = $model->id;
                        $modelDetail->save();
                    }
                    foreach ($modelDetails2 as $c => $modelDetail2) {

                        $modelDetail2->showcase_id = $model->id;
                        $modelDetail2->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelDetails' => $modelDetails,
            'modelDetails2' => $modelDetails2,
        ]);
    }

    /**
     * Updates an existing Showcase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelDetails = $model->showcaseProfiles;
        $modelDetails2 = $model->showcaseOwners;

        $formDetails = Yii::$app->request->post('ShowcaseProfile', []);
        $formDetails2 = Yii::$app->request->post('ShowcaseOwner', []);
        foreach ($formDetails as $i => $formDetail) {
            //loading the models if they are not new
            if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != ShowcaseProfile::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail = ShowcaseProfile::findOne(['id' => $formDetail['id'], 'showcase_id' => $model->id]);
                $modelDetail->setScenario(ShowcaseProfile::SCENARIO_BATCH_UPDATE);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[$i] = $modelDetail;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail = new ShowcaseProfile(['scenario' => ShowcaseProfile::SCENARIO_BATCH_UPDATE]);
                $modelDetail->setAttributes($formDetail);
                $modelDetails[] = $modelDetail;
            }

        }
        foreach ($formDetails2 as $i => $formDetail2) {
            //loading the models if they are not new
            if (isset($formDetail2['id']) && isset($formDetail2['updateType']) && $formDetail2['updateType'] != ShowcaseOwner::UPDATE_TYPE_CREATE) {
                //making sure that it is actually a child of the main model
                $modelDetail2 = ShowcaseOwner::findOne(['id' => $formDetail2['id'], 'showcase_id' => $model->id]);
                $modelDetail2->setScenario(ShowcaseOwner::SCENARIO_BATCH_UPDATE);
                $modelDetail2->setAttributes($formDetail2);
                $modelDetails2[$i] = $modelDetail2;
                //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
            } else {
                $modelDetail2 = new ShowcaseOwner(['scenario' => ShowcaseOwner::SCENARIO_BATCH_UPDATE]);
                $modelDetail2->setAttributes($formDetail2);
                $modelDetails2[] = $modelDetail2;
            }

        }

        //handling if the addRow button has been pressed
        if (Yii::$app->request->post('addRowPhoto') == 'true') {
            $modelDetails[] = new ShowcaseProfile(['scenario' => ShowcaseProfile::SCENARIO_BATCH_UPDATE]);
            return $this->render('update', [
                'model' => $model,
                'modelDetails' => $modelDetails,
                'modelDetails2' => $modelDetails2
            ]);
        }
        if (Yii::$app->request->post('addRowOwner') == 'true') {
            $modelDetails2[] = new ShowcaseOwner(['scenario' => ShowcaseOwner::SCENARIO_BATCH_UPDATE]);
            return $this->render('update', [
                'model' => $model,
                'modelDetails' => $modelDetails,
                'modelDetails2' => $modelDetails2
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {


            if (Model::validateMultiple($modelDetails) && Model::validateMultiple($modelDetails2) && $model->validate()) {
                $file = UploadedFile::getInstance($model, 'main_photo_file');
                //print_r($file);
                if (isset($file->size) && $file->size !== 0) {
                    //   $model->main_photo = $file->baseName . '.' . $file->extension;
                    //   $file->saveAs('uploads/showcase/' . $file->baseName . '.' . $file->extension);
                    $old_name = $model->main_photo;
                    $unique_name = "showcase_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                    $path = $unique_name . ".{$file->extension}";
                    $model->main_photo = $path;
                    $file->saveAs('uploads/showcase/' . $path);
                    if (isset($old_name)) {
                        unlink('uploads/showcase/' . $old_name);
                    } else {
                        // Do nothing
                    }
                }
                $model->save();
                foreach ($modelDetails as $c => $modelDetail) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail->updateType == ShowcaseProfile::UPDATE_TYPE_DELETE) {
                        $modelDetail->delete();
                    } else {
                        //new or updated records go here
                        ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'showcase_photo');
                        if (isset(${'profile_file' . $c}->size) && ${'profile_file' . $c}->size != 0) {
                            //    $modelDetail->showcase_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                            //   ${'profile_file' . $c}->saveAs('uploads/showcase/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                            $old_name = $modelDetail->showcase_url;
                            $unique_name = "showcase_" . date("Y-m-d_H-i-s") . "_" . uniqid();
                            $path = $unique_name . ".{${'profile_file' . $c}->extension}";
                            $modelDetail->showcase_url = $path;
                            ${'profile_file' . $c}->saveAs('uploads/showcase/related_photo/' . $path);
                            if (isset($old_name)) {
                                unlink('uploads/showcase/related_photo/' . $old_name);
                            } else {
                                // Do nothing
                            }
                        }
                        $modelDetail->showcase_id = $model->id;
                        $modelDetail->save();
                    }
                }
                foreach ($modelDetails2 as $c => $modelDetail2) {
                    //details that has been flagged for deletion will be deleted
                    if ($modelDetail2->updateType == ShowcaseOwner::UPDATE_TYPE_DELETE) {
                        $modelDetail2->delete();
                    } else {
                        //new or updated records go here

                        $modelDetail2->showcase_id = $model->id;
                        $modelDetail2->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('update', [
            'model' => $model,
            'modelDetails' => $modelDetails,
            'modelDetails2' => $modelDetails2
        ]);

    }
    /* public function actionUpdate($id)
     {
         $model = $this->findModel($id);
         $modelDetails = $model->showcaseProfiles;

         $formDetails = Yii::$app->request->post('ShowcaseProfile', []);
         foreach ($formDetails as $i => $formDetail) {
             //loading the models if they are not new
             if (isset($formDetail['id']) && isset($formDetail['updateType']) && $formDetail['updateType'] != ShowcaseProfile::UPDATE_TYPE_CREATE) {
                 //making sure that it is actually a child of the main model
                 $modelDetail = ShowcaseProfile::findOne(['id' => $formDetail['id'], 'showcase_id' => $model->id]);
                 $modelDetail->setScenario(ShowcaseProfile::SCENARIO_BATCH_UPDATE);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[$i] = $modelDetail;
                 //validate here if the modelDetail loaded is valid, and if it can be updated or deleted
             } else {
                 $modelDetail = new ShowcaseProfile(['scenario' => ShowcaseProfile::SCENARIO_BATCH_UPDATE]);
                 $modelDetail->setAttributes($formDetail);
                 $modelDetails[] = $modelDetail;
             }

         }

         //handling if the addRow button has been pressed
         if (Yii::$app->request->post('addRow') == 'true') {
             $modelDetails[] = new ShowcaseProfile(['scenario' => ShowcaseProfile::SCENARIO_BATCH_UPDATE]);
             return $this->render('update', [
                 'model' => $model,
                 'modelDetails' => $modelDetails
             ]);
         }
         if ($model->load(Yii::$app->request->post())) {
             $file = UploadedFile::getInstance($model, 'main_photo_file');
             //print_r($file);
             if (isset($file->size) && $file->size !== 0) {
                 $model->main_photo = $file->baseName . '.' . $file->extension;
                 $file->saveAs('uploads/showcase/' . $file->baseName . '.' . $file->extension);
             }
             $model->save();
             if (Model::validateMultiple($modelDetails)) {
             //    print_r($modelDetails);
                 foreach ($modelDetails as $c => $modelDetail) {

                     //details that has been flagged for deletion will be deleted
                     if ($modelDetail->updateType == ShowcaseProfile::UPDATE_TYPE_DELETE) {
                         $modelDetail->delete();
                     } else {
                         //new or updated records go here
                         ${'profile_file' . $c} = UploadedFile::getInstance($modelDetail, '[' . $c . ']' . 'showcase_photo');
                         if (${'profile_file' . $c}->size != 0) {
                             $modelDetail->showcase_url = ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension;
                             ${'profile_file' . $c}->saveAs('uploads/showcase/related_photo/' . ${'profile_file' . $c}->baseName . '.' . ${'profile_file' . $c}->extension);
                         }
                         $modelDetail->showcase_id = $model->id;
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
     }*/

    /**
     * Deletes an existing Showcase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $showcase_langs = $this->findModel($id)->getShowcaseLangs()->where(['showcase_id' => $id])->all();
        foreach ($showcase_langs as $showcase_lang) {
            $showcase_lang->delete();
        }
        $showcase_profiles = $this->findModel($id)->getShowcaseProfiles()->where(['showcase_id' => $id])->all();
        foreach ($showcase_profiles as $showcase_profile) {
            unlink('uploads/showcase/related_photo/' . $showcase_profile->showcase_url);
            $showcase_profile->delete();
        }
        if (isset($this->findModel($id)->main_photo)) {
            unlink('uploads/showcase/' . $this->findModel($id)->main_photo);
        } else {

        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Showcase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Showcase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Showcase::find()->multilingual()->where(['showcase.id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }


}

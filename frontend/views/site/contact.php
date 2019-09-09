<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('common', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
define('PAGE_NAME', 'contact');
?>
<div id="contact-page" class="container">

    <div class="row mt-4 mb-4">
        <div class="col-12 mb-3 viewpoint-animate d03s" data-animation="fadeInDown">
            <p class="bigger-160 font-weight-normal text-purple mb-0"><?php echo Yii::t('common', 'Contact Us');;?></p>
        </div>
        <div class="col-lg-7 col-12 mb-2 fadeIn animated d03s">
            <div class="row">
                <div class="col-md-2 col-12"><label class="bold"><?php echo Yii::t('common', 'address');?></label></div>
                <div class="col-md-10 col-12">
                    <div class="smaller-90"><?php echo Yii::t('common', 'address_content_1');?></div>
                    <div class="smaller-90"><?php echo Yii::t('common', 'address_content_2');?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-12"><label class="bold"><?php echo Yii::t('common', 'phone');?></label></div>
                <div class="col-md-10 col-12"><span class="smaller-90">053-920299</span></div>
            </div>
            <div class="row">
                <div class="col-md-2 col-12"><label class="bold"><?php echo Yii::t('common', 'email');?></label></div>
                <div class="col-md-10 col-12"><span class="smaller-90">dchudasri@yahoo.com</span></div>
            </div>
            <div class="row">
                <div class="col-md-2 col-12"><label class="bold"><?php echo Yii::t('common', 'website');?></label></div>
                <div class="col-md-10 col-12"><a href="#" class="smaller-90">Academia.edu</a></div>
            </div>
            <?php if (Yii::$app->session->hasFlash('successContact') || Yii::$app->session->hasFlash('errorContact')): ?>
                <?php  if (Yii::$app->session->hasFlash('successContact')): ?>
                    <div class="alert alert-success">
                        Thank you for contacting us. We will respond to you as soon as possible.
                    </div>
                <?php elseif(Yii::$app->session->hasFlash('errorContact')): ?>
                    <div class="alert alert-warning">
                        There was an error sending your message.
                    </div>
                <?php endif; ?>
            <?php else: ?>
            <p class="bigger-110 bold mt-3"><?php echo Yii::t('common', 'send_email');?></p>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => 'Name *', 'aria-required' => true])->label(false) ?>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <?= $form->field($model, 'email')->textInput(['type' => 'email', 'autofocus' => true, 'class' => 'form-control', 'max-length' => '30', 'placeholder' => 'Email *', 'aria-required' => true])->label(false) ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'subject')->textInput(['autofocus' => true, 'class' => 'form-control', 'max-length' => '40', 'placeholder' => 'Topic *', 'aria-required' => true])->label(false) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Message *'])->label(false) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['options' => [
                    'placeholder' => 'Enter the letters displayed',
                    'class' => 'form-control form-custom',
                ],
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>'])->label(false) ?>
           
            </div>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('common', 'submit'), ['class' => 'btn btn-primary', 'name' => 'contact-submit']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-5 col-12">
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.948379579661!2d98.94821451451008!3d18.800453687246563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3a6bf542deb3%3A0x85fbac3033920444!2z4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4Lio4Li04Lil4Lib4LiwIOC4quC4t-C5iOC4rSDguYHguKXguLDguYDguJfguITguYLguJnguYLguKXguKLguLU!5e0!3m2!1sth!2sth!4v1524240809546" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
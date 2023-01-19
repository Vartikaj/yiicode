<?php

/** @var \frontend\models\UserFrom $useform */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Personal Infromation';

?>

<h1><?= Html::encode($this->title) ?></h1>

<!--THIS IF CONDITION EXECUTE OUR CODE WHEN THE FORM DATA IN SUBMITTED
AND CHNAGE THE PAGE LAYOUT -->
<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')){ ?>

<div class="row">

   <div class="col-lg-5">

       <div class="panel panel-default">

           <div class="panel-heading">Message Sent</div>

           <div class="panel-body">


               <p><b>Name:</b> <?=$useform->name?> </p>

               <p><b>Email:</b> <?=$useform->email?> </p>

               <p><b>Address:</b> <?=$useform->address?> </p>

           </div>

       </div>

       <div class="alert alert-success">

           Thank you for contacting us. We will respond to you as soon as possible.

       </div>

   </div>

</div>
<!--================-->

<?php }else if(Yii::$app->session->hasFlash('updateformcontent')){ ?>
    <div class="row">
        <div class="col-lg-5">
        <?php $id = \Yii::$app->user->identity->id ?>
        <?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
            <!--USING THIS LINE OF CODES WE ARE ABLE TO REPRESENT THE DATA INTO THE FORM FIELD IN YII2-->
            <?php foreach($userformmodel as $database): ?>
                <?= $form->field($useform, 'name')->textInput(['value'=>$database->name]); ?>
                <?= $form->field($useform,'email')->textInput(['value'=>$database->email]); ?>
                <?= $form->field($useform,'address')->textInput(['value'=>$database->address]); ?>   
            <?php endforeach; ?>
            

            <!--<div class="form-group">

                /// Html::submitButton($useform->isNewRecord?'Create':'Update', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

            </div>-->

            <div class="form-group">
            <?= Html::submitButton('UPDATE', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            <!--FOR DELETE BUTTON-->
            <?= Html::a('Delete',['delete','id' => $useform->userid],[
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])?>
            </div>

        <?php ActiveForm::end(); ?>

        </div>
    </div>

<?php }else if(Yii::$app->session->hasFlash('updateform')){
    ?>
    <p>Data Updated</p>
    <?php

}else{ ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $id = \Yii::$app->user->identity->id ?>
            <?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
                <!-- <input name="id" type="number" id="id" class="form-control" value="<?php echo $id ?>" readonly ><br/> -->

                <?= $form->field($useform, 'name') ?>
                <?= $form->field($useform, 'email') ?>
                <?= $form->field($useform, 'address')->textArea(['rows' => 6]) ?>
                <div class="form-group">
                <?= Html::submitButton('create', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

        </div>
    </div>

<?php } ?>
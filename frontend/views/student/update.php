<?php
use yii\bootstrap4\Html;

use yii\bootstrap4\ActiveForm;
/** @var yii\web\View $this */

$this->title = 'CURD Operation Form';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">YII2 Update Operation</h1>

        </div>
    </div>
    <!-- <?php //echo "<pre>".print_r($queryData)."</pre>"; ?> -->

    
    <div class="body-content">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['options' => ['method' => 'post']]); ?>
                <?php foreach($updatedata as $querydata):?>
                    <?= $form->field($student,'name')->textInput(['value'=>$querydata['name']]); ?>
                    <?= $form->field($userform,'address')->textInput(['value'=>$querydata['address']]);?>
                <?php endforeach;?>
                <div class="form-group">
                    <?= Html::submitButton('Update',['class' => 'btn btn-primary', 'name' => 'update-button'])?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

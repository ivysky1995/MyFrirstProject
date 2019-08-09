<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProjectUser;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php 
        $projectUser = new ProjectUser(['project_id'=>$model->id]);
        $users = User::find()->all();
        $userMap = [];
        
        foreach ($users as $user){
            $userMap[$user->id] = $user->name;
        }
        if ($projectUser){
            
            if ($projectUser->privilege = 2){
                
                echo $form->field($projectUser, 'user_id')->dropDownList($userMap);
                echo $form->field($projectUser, 'privilege')->radioList($projectUser::privilegeOptionArr());
                
            }
        }
        
       
        
        
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

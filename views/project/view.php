<?php

use app\models\ProjectUser;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('View Term',['/term/index','projectId'=> $model->id],['class'=>'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>
    <h2>User</h2>
    
    <table class="table table-striped table-bordered">
        <tr>
            <th>User</th>
            <th>Privilege</th>
            <th>Remove</th>
            <th>Created at</th>
            
            
            
        </tr>
        <?php foreach ($model->users as $user){ ?>
        <?php 
            $projectUser = \app\models\ProjectUser::findOne(['project_id'=>$model->id,'user_id'=>$user->id]);
        ?>
        <?php $projectUsername = $projectUser->user->name?>
        <? echo $projectUsername; ?>
        <tr>
            <td> <?= $projectUser->user->name ?></td>
            <td><?= $projectUser->privilegeStr ?></td>
            <td><?= Html::a('Remove',['remove', 'projectUserId' => $projectUser->id],[
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => "Are you sure you want to delete $projectUsername ?",
                    'method' => 'post',
                
            ]])?></td>
            <td> <?php 
            echo Yii::$app->formatter->asTime($projectUser->created_at ); ?></td>
            
            
            
        </tr>
        <?php } ?>
    
    </table>
    <?php if (Yii::$app->user->can('manager')){?>
    <h2>Add Project User</h2>
    
    <?php $form = ActiveForm::begin([
        'action' =>['create-project-user'],
    ]); ?>
    <?php 
        $projectUser = new ProjectUser(['project_id'=>$model->id]);
        $users = User::find()->all();
        $userMap = [];
        foreach ($users as $user){
            $userMap[$user->id] = $user->name;
        }
    ?>
    <?= $form->field($projectUser,'project_id')->hiddenInput()->label(false) ?>
    
    <?= $form->field($projectUser,'user_id')->dropDownList($userMap,[
        'prompt'=>'Select User'
    ]) ?>
    
    <?= $form->field($projectUser,'privilege')->radioList($projectUser::privilegeOptionArr()) ?>
    
    <div class= "form-group">
    
    <?= Html::submitButton('Add',['class'=>'btn btn-success']) ?>
    
    </div>
    
    <?php ActiveForm::end() ?>
    <?php } ?>

</div>

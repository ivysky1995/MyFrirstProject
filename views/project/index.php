<?php

use app\models\Project;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (\Yii::$app->user->can('admin')){?>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{termlist} {view} {update} {delete}',
                'buttons'=>[
                    'termlist' =>function ($url, Project $model){
                    return Html::a('Term List',['/term/index','projectId'=>$model->id],['class'=>'btn btn-xs btn-primary']);
                    },
                    'view'=>function ($url,$model){
                    return Html::a('View',$url,['class'=>'btn btn-l btn-primary']);
                    },
                    'update'=>function ($url,$model){
                    return Html::a('Update',$url,['class'=>'btn btn-xs btn-success']);
                    },
                    'delete' =>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>Delete',$url,[
                        'class'=>'btn btn-xs btn-danger',
                        'data-confirm' =>'Do you want to delete?',$model->name,
                        'data-method'=>'POST'
                        
                    ]);
                    },
                ],
                
            ],
        ],
    ]); ?>


</div>

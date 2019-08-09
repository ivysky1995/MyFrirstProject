<?php

namespace app\controllers;

use app\models\Project;
use app\models\ProjectSearch;
use app\models\ProjectUser;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class'=>AccessControl::className(),
               
                'rules' => [
                    [
                        'actions'=>['login','error'],
                        'allow' =>true,
                        'roles'=>'?',
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['view'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['index'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['create'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['delete'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['update'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['remove'],
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create-project-user'],
                        'roles' => ['manager'],
                    ],
                    
                    
                    ],
                ],
            ];
    }
    

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionEdituser($projectUserId){
        $model = ProjectUser::findOne($projectUserId);
        if ($model->load(Yii::$app->request->post()) && $model->save() ){
            return $this->redirect(['view','projectUserId'=>$model->project_id]);
        }
        return $this->render('edituser',[
            'model'=>$model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
     public function actionRemove($projectUserId = null)
     {
         $model = ProjectUser::findOne($projectUserId);
         $model->user_id = $projectUserId;
         if ($model){
             $model->delete();
         }
         
         return $this->redirect(['view','id'=>$model->project_id]);
 
        
     }
//     protected function findUserId($id){
//         $projectUser = \app\models\ProjectUser::findOne(['project_id'=>$model->id,'user_id'=>$user->id]);
        
//         if (($projectUser = ProjectUser::findOne(['project_id'=>$projectUser->project_id,'user_id'=>$projectUser->user_id])) !== null){
//             return $projectUser;
            
//         }
//         throw new NotFoundHttpException('The requested page does not exist.');
//     }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionCreateProjectUser()
    {
        
        $projectUser = new ProjectUser();
       
  
        
        if ($projectUser->load(Yii::$app->request->post())){
            $projectUser->created_at = time();
            $model = ProjectUser::findOne(['project_id'=>$projectUser->project_id,'user_id'=>$projectUser->user_id]);
            if (!$model){
                $model = $projectUser;
                
            }else{
                $model->privilege = $projectUser->privilege;
                $model->created_at = $projectUser->created_at;
                
            }
            $model->created_at = $projectUser->created_at;
            $model->save();
            
        }
        return $this->redirect(['view','id'=>$model->project_id]);
    }
}

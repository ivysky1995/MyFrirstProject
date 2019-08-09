<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        
        
        $create = $auth->createPermission('create');
        $create->description = 'create';
        $auth->add($create);
        
        $view = $auth->createPermission('view');
        $view->description = 'view';
        $auth->add($view);
        
        $index = $auth->createPermission('index');
        $index->description = 'index';
        $auth->add($index);
        
        $update = $auth->createPermission('update');
        $update->description = 'update';
        $auth->add($update);
        
        $delete = $auth->createPermission('delete');
        $delete->description = 'delete';
        $auth->add($delete);
        
        $user = $auth->createRole('user');
        $auth->add($user);
        
        $auth->addChild($user, $index);
        $auth->addChild($user, $view);
        
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        
        $manager = $auth->createRole('manager');
        $auth->add($manager);
        
        $auth->addChild($manager, $user);
        $auth->addChild($manager, $update);
        $auth->addChild($manager, $delete);
        
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $create);
        
        $auth->assign($admin, 1);
        $auth->assign($manager, 2);
        for ($i=3;$i<=1000;$i++){
            $auth->assign($user,$i);
        }
        
        
        
        
           
        
        
        
        
       
        
        
        
        
    }
}
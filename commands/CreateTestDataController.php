<?php
namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;
use app\models\Project;

class CreateTestDataController extends Controller
{
    /**
     * Syntax:
     *   ./yii create-test-data
     */
    public function actionIndex()
    {
        $this->createUsers();
        $this->createProjects();
        //         $this->createProjectUsers();
        return ExitCode::OK;
    }
    
    private function createUsers()
    {
        for ($i = 1; $i <= 20; $i++) {
            $user = new User(['name' => "User $i"]);
            $user->save();
        }
    }
    
    private function createProjects()
    {
        for ($i = 21; $i <= 40; $i++) {
            $project = new Project(['name' => "User $i"]);
            $project->save();
        }
    }
}

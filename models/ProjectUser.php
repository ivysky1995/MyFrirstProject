<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_user".
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property int $privilege
 */
class ProjectUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const PRIVILEGE_MANAGER = 2;
    const PRIVILEGE_NORMAL = 1;
    public static function tableName()
    {
        return 'project_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'privilege'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
            'privilege' => 'Privilege',
        ];
    }
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id'=>'project_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
        
    }
    public static function privilegeOptionArr()
    {
        return [
            self::PRIVILEGE_MANAGER =>'Manager',
            self::PRIVILEGE_NORMAL =>'Normal User',
        ];
        
    }
    public function getPrivilegeStr(){
        return ArrayHelper::getValue(self::privilegeOptionArr(),$this->privilege,'Normal User');
        
    }
}

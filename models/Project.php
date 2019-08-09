<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            
            'name' => 'Name',
        ];
    }
    public function getProjectUsers()
    {
        return $this->hasMany(ProjectUser::className(),['project_id'=>'id']);
    }
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id'=>'user_id'])
        ->via('projectUsers');
    }
    public function getTerm()
    {
        return $this->hasMany(Term::className(), ['project_id'=>'id']);
    }
    public function delete()
    {
        Term::deleteAll(['project_id'=>$this->id]);
        parent::delete();
    }
    public function remove(){
        ProjectUser::deleteAll(['user_id'=>$this->id]);
        parent::remove();
        
    }
}

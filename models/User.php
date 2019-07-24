<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
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
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
    public function getProjectUsers()
    {
        return $this->hasMany(User::className(),['user_id'=>'id']);
    }
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id'=>'project_id'])
        ->via('projectUsers');
    }
}

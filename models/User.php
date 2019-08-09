<?php

namespace app\models;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
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
            [['name', 'email'], 'required'],
            [['name', 'email', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
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
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type=null){
        return self::findOne(['accessToken'=>$token]);
    }
    
    public static function findByUsername($name)
    {
        return self::findOne(['name'=>$name]);
    }
    
    public function getId(){
        return $this->id;
    }
    public function getAuthKey(){
        return $this->authKey;
    }
    public function validateAuthKey($authKey) {
        return $this->authKey ===$authKey;
    }
    public function validatePassword($password){
        return $this->password === $password;
    }
    
  
}

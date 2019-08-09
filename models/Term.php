<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "term".
 *
 * @property int $id
 * @property int $project_id
 * @property string $word_vi
 * @property string $word_jp
 */
class Term extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'term';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id'], 'integer'],
            [['word_vi', 'word_jp'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
       
            'project_id' => 'Project ID',
            'word_vi' => 'Word Vi',
            'word_jp' => 'Word Jp',
        ];
    }
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id'=>'project_id']);
    }
    public function getProjectName()
    {
        return $this->project_id ? $this->project->name : null;
    }
}

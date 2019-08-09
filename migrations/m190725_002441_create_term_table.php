<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%term}}`.
 */
class m190725_002441_create_term_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%term}}', [
            'id' => $this->primaryKey(),
            'project_id'=>$this->integer(),
            'word_vi'=>$this->string(),
            'word_jp'=>$this->string(),
            
         
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%term}}');
    }
}

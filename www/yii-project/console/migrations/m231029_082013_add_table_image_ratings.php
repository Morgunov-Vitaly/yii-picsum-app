<?php

use yii\db\Migration;

class m231029_082013_add_table_image_ratings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('images_ratings', [
            'id' => $this->primaryKey(),
            'ext_id' => $this->integer()->notNull()->unique()->comment('Внешний ID изображения'),
            'url' => $this->string()->comment('Ссылка на изображение'),
            'is_approved' => $this->boolean()->comment('Флаг одобрено ли изображение'),
        ]);

        $this->createIndex('images_ratings_ext_id_is_approved', 'images_ratings', ['ext_id', 'is_approved']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('images_ratings_ext_id_is_approved', 'images_ratings');
        $this->dropTable('images_ratings');
    }
}

<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class ImageRates extends ActiveRecord
{
    public ?int $id = null;
    public ?int $ext_id = null;
    public ?bool $is_approved = null;
    public ?string $url = null;

    public static function tableName(): string
    {
        return 'images_ratings';
    }

    public function fields(): array
    {
        return [
            'id',
            'ext_id',
            'is_approved',
            'url'
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => '#ID',
            'ext_id' => 'Внешний ID',
            'is_approved' => 'Оценка',
            'url' => 'Ссылка',
        ];
    }

    public function rules(): array
    {
        return [
            [['ext_id', 'url', 'is_approved'], 'required'],
            ['is_approved', 'boolean'],
            ['url', 'string'],
            ['url', 'trim'],
            [['ext_id', 'id'], 'integer']
        ];
    }

    public function save($runValidation = true, $attributeNames = null): bool
    {

        return parent::save($runValidation, $attributeNames);
    }
}
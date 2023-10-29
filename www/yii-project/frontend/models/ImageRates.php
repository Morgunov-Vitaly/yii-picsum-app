<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class ImageRates extends ActiveRecord
{
    public int $id;
    public int $extId;
    public bool $isApproved;
    public string $url;

    public static function tableName(): string
    {
        return 'images_ratings';
    }

    public function fields(): array
    {
        return [
            'id',
            'extId' => 'ext_id',
            'isApproved' => 'is_approved',
            'url'
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => '#',
            'extId' => 'Внешний ID',
            'isApproved' => 'Оценка',
            'url' => 'Ссылка',
        ];
    }

    public function rules(): array
    {
        return [
            [['extId', 'url', 'isApproved'], 'required'],
            ['isApproved', 'boolean'],
            ['url', 'string', 'trim'],
            [['extId', 'id'], 'integer']
        ];
    }

    public function findOne(){

    }

    public function save($runValidation = true, $attributeNames = null): bool
    {

        return parent::save($runValidation, $attributeNames);
    }
}
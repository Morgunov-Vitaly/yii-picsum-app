<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\grid\ActionColumn;
use yii\helpers\Html;

/**
 * @property int $id
 * @property int $ext_id
 * @property bool $is_approved
 * @property string $url
 */
class ImageRates extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%images_ratings}}';
    }

    public function rules(): array
    {
        return [
            [['ext_id', 'url', 'is_approved'], 'required'],
            ['is_approved', 'boolean'],
            ['url', 'string'],
            ['url', 'trim'],
            [['ext_id', 'id'], 'integer'],
            ['ext_id', 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => '#ID',
            'ext_id' => 'Внешний ID',
            'is_approved' => 'Решение',
            'url' => 'Ссылка',
        ];
    }

    public static function columns(): array
    {
        return [
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'ID',
                'attribute' => 'id',
                'content' => function($model, $key, $index, $column){
                    return Html::a($model->id, $model->url);
                }
            ],
            'ext_id',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'is_approved',
                'content' => function($model, $key, $index, $column){
                        if ($model->is_approved) {
                            return Html::tag('span', 'Одобрена');
                        }
                    return Html::tag('span', 'Отклонена');
                }
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'url',
                'content' => function($model, $key, $index, $column){
                    return Html::a($model->url, $model->url);
                }
            ],
            [
                'class' => ActionColumn::class,
                'header' => 'Действие',
                'template' => '{delete}',
            ],
        ];
    }
}
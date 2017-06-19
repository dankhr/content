<?php

namespace app\models;

use yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "w15_news".
 *
 * @property integer $id
 * @property string $header
 * @property string $annotation
 * @property string $full_text
 * @property string $ext_image
 * @property string $start_date
 * @property string $finish_date
 * @property integer $state
 * @property integer $count_views
 * @property integer $id_author
 */
class News extends \yii\db\ActiveRecord
{
    public $image;

    const STATUS_NEW = 0;
    const STATUS_AGREE = 1;
    const STATUS_DISCARD = 2;

    // Получить русское название статуса по константе (должна быть в поле status)
    public static function getStatusName($param)
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $param);
    }

    // Получить ассоциативный массив всех статусов с их русскими названиями
    public static function getStatusesArray()
    {
        return [
            self::STATUS_NEW => 'Ожидает подтверждения модератором',
            self::STATUS_AGREE => 'Опубликована',
            self::STATUS_DISCARD => 'Отклонена'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'w15_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header', 'annotation', 'full_text', 'ext_image', 'start_date', 'finish_date'], 'required'],
            [['start_date', 'finish_date'], 'date', 'format' => 'php:Y-m-d'],
            [['state', 'count_views'], 'integer'],
            [['header'], 'string', 'max' => 100],
            [['annotation'], 'string', 'max' => 200],
            [['full_text'], 'string', 'max' => 1024],
            [['ext_image'], 'string', 'max' => 4],
            [['image'], 'file', 'skipOnEmpty' => 'false', 'extensions'=>'jpg, gif, png, jpeg', 'message' => 'Не выбрано изображение']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Заголовок',
            'annotation' => 'Аннотация',
            'full_text' => 'Текст новости',
            'image' => 'Изображение',
            'start_date' => 'Дата начала',
            'finish_date' => 'Дата окончания',
            'state' => 'Статус',
            'count_views' => 'Количество просмотров',
        ];
    }
}

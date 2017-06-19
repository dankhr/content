<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\News;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'header',
            'annotation',
            'full_text',
            //'ext_image',
             'start_date',
             'finish_date',
            [
                'attribute' => 'state',
                'value' => function($data) {
                    return News::getStatusName($data->state);
                }
            ],
            // 'count_views',
            // 'id_author',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

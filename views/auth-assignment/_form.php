<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $items = [
        'editor' => 'Редактор',
        'moderator' => 'Модератор',
        'author' => 'Автор'
    ];
    $params = [
        'prompt' => 'Выберите роль...'
    ];
    echo $form->field($model, 'item_name')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Применить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

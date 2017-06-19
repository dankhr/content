<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_text')->widget(CKEditor::className(),[
            'editorOptions' => [
                'preset' => 'full', //разработаны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ])
    ?>

    <?php
    if (!empty($model->id)) {
        $previewImg = '/upload/news' . $model->id . '.' . $model->ext_image;
        echo "<label class='control-label'>Предыдущее изображение</label><br><img src='" . $previewImg . "' alt='Превью новости' width='200px'><br>";
    }
    ?>


    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png', 'jpeg'],'showUpload' => false,],
        ])
    ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']) ?>

    <?= $form->field($model, 'finish_date')->widget(\yii\jui\DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']) ?>

    <?= $form->field($model, 'state')->dropDownList($model->getStatusesArray()) ?>

    <?= $form->field($model, 'count_views')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Применить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

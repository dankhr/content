<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Главная';
?>
<div class="site-index">
    <? if(Yii::$app->session->hasFlash('reg-success')) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('reg-success') ?>
        </div>
    <? endif; ?>

    <h3>Система коллективного наполнения контентом</h3>
    <p>Выполнил: студент группы ВВТ-408 Д. Г. Хрущёв.</p>
    <p>Проверил: доцент кафедры ВИТ Д. Н. Лясин.</p>
    <p>Разработать Web-приложение, которое позволяет зарегистрированным пользователям
        формировать информационное наполнения ресурса в виде статей. Предусмотреть две роли:
        модератор и автор. Для авторов предусмотреть возможность регистрации в системе. </p>
    <p>Пользователи авторы должны иметь возможность добавлять небольшие новостные
        блоки в базу системы. Новость должна включать:
    </p>
    <ul>
        <li>заголовок;</li>
        <li>аннотацию;</li>
        <li>текст новости;</li>
        <li>картинка;</li>
        <li>даты отображения новости в системе (с какого по какое число).</li>
    </ul>
    <p>Модератор имеет возможность просматривать все добавленные новости, а также
        разрешать их публикацию либо отклонять. </p>
    <p>Аннотации всех разрешенных модератором к публикации новостей отображаются на
        главной странице системы (доступной всем посетителям сайта) весь указанный при
        добавлении период времени. По щелчку на аннотацию должен осуществляться переход на
        подробное содержание новости. </p>
    <p>
        Аннотации отображать в порядке убывания популярности новостей (количества
        просмотров в полной форме).
    </p>
    <br>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

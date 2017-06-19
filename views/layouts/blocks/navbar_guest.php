<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

NavBar::begin([
    'brandLabel' => '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;Система коллективного наполнения контентом',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Новости', 'url' => ['/site/news']],
        ['label' => 'Регистрация', 'url' => ['/site/register']]
    ],
]);
NavBar::end();
?>

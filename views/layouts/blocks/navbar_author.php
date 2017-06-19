<?php
    use yii\bootstrap\NavBar;
    use yii\bootstrap\Nav;
    use yii\helpers\Html;

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
            ['label' => 'Мои новости', 'url' => ['/author']],
            ['label' => 'Опубликованные новости', 'url' => ['/site/news']],
            ['label' => 'Добавить новость', 'url' => ['/author/add-news']],

            (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

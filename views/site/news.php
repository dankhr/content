<? use yii\widgets\LinkPager; ?>
<?php $this->title = "Лента новостей" ?>

<div id="news-block">
    <?php foreach ($news as $one_news) {?>

    <h3>
        <?= $one_news->header ?>
    </h3>
    <?= $one_news->annotation ?>
    <div style="margin-bottom: 20px;">
        <a href="/site/one-news?id=<?= $one_news->id ?>" title="Прочитать новость">Подробнее</a>
    </div>
    <span class="glyphicon glyphicon-eye-openglyphicon glyphicon-eye-open" aria-hidden="true"></span> <?= $one_news->count_views ?>
    <hr>

    <? } ?>
    <?= LinkPager::widget(['pagination' => $pages]) ?>
</div>

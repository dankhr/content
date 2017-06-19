<?php $this->title = "Новость" ?>
<?
    if (!empty(Yii::$app->request->referrer))
        echo \yii\helpers\Html::a('Назад', Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ."<br><br>";
?>
<h3><?= $one_news['header']; ?></h3>
<div style="margin-bottom: 20px;">
    <?php
    if (!empty($one_news['id'])) {
        $previewImg = '/upload/news' . $one_news['id'] . '.' . $one_news['ext_image'];
        echo "<img src='" . $previewImg . "' alt='Новость' style='max-width:50%;'><br>";
    }
    ?>
</div>

<?= $one_news['full_text']; ?>
<br><br>
<span class="glyphicon glyphicon-eye-openglyphicon glyphicon-eye-open" aria-hidden="true"></span> <?= $one_news['count_views']+1 ?>


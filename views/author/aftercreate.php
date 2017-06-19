<?php

use yii\helpers\Html;

$this->title = "Новость принята";
?>
<p>Новость отправлена на рассмотрение модератору</p>
<?= Html::a('Добавить новость', ['/author/add-news'], ['class' => 'btn btn-primary']) ?>

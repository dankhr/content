<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        if (Yii::$app->user->isGuest) { // Если гость
            $this->beginContent('@app/views/layouts/blocks/navbar_guest.php');
            $this->endContent();
        } else {
            if (Yii::$app->user->can('adminRole')) {  // Если админ
                $this->beginContent('@app/views/layouts/blocks/navbar_admin.php');
                $this->endContent();
            } else {
                if (Yii::$app->user->can('editorRole')) {  // Если редактор
                    $this->beginContent('@app/views/layouts/blocks/navbar_editor.php');
                    $this->endContent();
                } else {
                    if (Yii::$app->user->can('moderatorRole')) {  // Если модератор
                        $this->beginContent('@app/views/layouts/blocks/navbar_moderator.php');
                        $this->endContent();
                    } else {
                        // Иначе автор
                        $this->beginContent('@app/views/layouts/blocks/navbar_author.php');
                        $this->endContent();
                    }
                }
            }
        }
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ВПИ <?= date('Y') ?> г.</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

use yii\helpers\Html;
use yii\mail\MessageInterface;
use yii\web\View;

/* @var $this View view component instance */
/* @var $message MessageInterface the message being composed */
/* @var $content string main view render result */

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>"/>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body style="background:#f9fafa;padding:20px;">
    <?php $this->beginBody() ?>
    <div style="margin:0 auto;max-width:600px;background:#fff;padding:20px;">
        <div style="text-align:center;margin:0 0 20px;padding:0 0 20px;border-bottom:5px solid #09B3B0;">
            <a style="color:#09B3B0;" href="https://<?= Yii::$app->params['domainRoot'] ?>">
                <img src="https://<?= Yii::$app->params['domainRoot'] ?>/img/logo-3.png" alt="Branson Restaurants">
            </a>
        </div>
        <?= $content ?>
        <div style="margin:20px 0 0;padding:20px 0 0;border-top:5px solid #09B3B0;"></div>
        <a style="color:#09B3B0;" href="https://<?=
        Yii::$app->params['domainRoot'] ?>">Vacation Channel</a> © <?= date('Y') ?> Tripium, LLC. All rights
        reserved.
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();

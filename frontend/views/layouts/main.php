
<?php

/**
 * @var string $content
 */

$this->beginContent('@app/views/layouts/general.php');
?>
<div class="wrapper-main">
    <?= $this->render('header') ?>
    <main class="pt-3">
        <div class="fixed overflow-hidden"><?= $content ?></div>
    </main>
    <?= $this->render('footer') ?>
</div>
<?php $this->endContent();


<?php

/**
 * @var string $content
 */

$this->beginContent('@app/views/layouts/general.php');
?>
<div class="fixed overflow-hidden"><?= $content ?></div>
<?php $this->endContent();

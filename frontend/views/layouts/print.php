<?php

use frontend\assets\PrintAsset;

PrintAsset::register($this);

/**
 * @var string $content
 */

$this->beginContent('@app/views/layouts/general.php');
?>
<div class="fixed overflow-hidden"><?= $content ?></div>
<?php $this->endContent();


<?php

/**
 * @var string $content
 */

use common\widgets\yii2CookieConsent\CookieConsent;

$this->beginContent('@app/views/layouts/general.php');
?>
<div class="wrapper-main">
    <?= $this->render('header') ?>
    <main class="pt-3">
        <div class="fixed overflow-hidden"><?= $content ?></div>
        <?= CookieConsent::widget([
          'name' => 'cookie_consent_status',
          'path' => '/',
          'domain' => '',
          'expiryDays' => 365,
          'message' => '',
          'save' => 'Save',
          'acceptAll' => 'Accept all',
          'controlsOpen' => 'Change',
          'detailsOpen' => 'Cookie Details',
          'learnMore' => 'Cookies Policy',
          'visibleControls' => false,
          'visibleDetails' => false,
          'link' => '/cookies-policy/',
          'consent' => [
              'cookie_necessary' => [
                  'label' => 'Necessary',
                  'checked' => true,
                  'disabled' => true
              ],
              'cookie_statistics' => [
                  'label' => 'Statistics',
                  'checked' => true,
                  'cookies' => [
                      ['name' => '_ga'],
                      ['name' => '_gat', 'domain' => '', 'path' => '/'],
                      ['name' => '_gid', 'domain' => '', 'path' => '/']
                  ],
                  'details' => [
                  ]
              ],
              'cookie_youtube' => [
                  'label' => 'Youtube',
                  'checked' => true,
              ]
          ]
      ]) ?>
    </main>
    <?= $this->render('footer') ?>
</div>
<?php $this->endContent();

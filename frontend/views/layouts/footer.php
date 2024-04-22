<?php

use yii\helpers\Url;

?>
<footer>
    <div class="fixed mb-5">
        <div class="contacts d-md-flex">
            <div class="text-center text-md-start">
                <div class="arrow"></div>
                <span class="icon icon-phone"></span>
                <span class="text-label mx-1 mx-xxl-3">Phone</span>
                <a href="tel:4172946505" class="phone-number d-xxl-inline d-md-block">(417) 294-6505</a>
            </div>
            <div class="text-center lines">
                <span class="icon icon-like"></span>
                <span class="text-label mx-1 mx-xxl-3">Connect</span>
                <span class="d-xxl-inline d-md-block">
                    <a href="https://www.facebook.com/TheVacationChannel" target="_blank">
                        <span class="icon icon-facebook-circle me-2"></span>
                    </a>
                    <a href="https://www.instagram.com/thevacationchannelbranson?igsh=dmVvZ3YwdjF4MjZv" target="_blank">
                        <span class="icon icon-instagram me-2"></span>
                    </a>
                    <a href="https://www.youtube.com/@TheVacationChannel" target="_blank">
                        <span class="icon icon-youtube"></span>
                    </a>
                </span>
            </div>
            <div class="text-center text-md-end">
                <span class="icon icon-email"></span>
                <span class="text-label mx-1 mx-xxl-3">E-mail</span>
                <a href="mailto:contact@tvcbranson.com"
                   class="text-white phone-number d-xxl-inline d-md-block">contact@tvcbranson.com</a>
            </div>
        </div>
    </div>
    <div class="fixed overflow-hidden">
        <div class="row">
            <div class="col-xl-8 text-center text-xl-start mb-3">
                <a href="<?= Url::to(['programming/index']) ?>" class="me-3 text-nowrap">Children's Programming</a>
                <a href="https://www.fcc.gov/" target="_blank" class="me-3 text-nowrap">
                    <img src="/img/fcc-logo.png" alt="FCC" /> FCC
                </a>
                <a href="mailto:contact@tvcbranson.com" class="me-3 text-nowrap">Contact</a>
                <a href="<?= Url::to(['site/about']) ?>" class="me-3 text-nowrap">About us</a>
            </div>
            <div class="col-xl-4 mb-5">
                <div class="text-center text-xl-end copyright">
                    ©<?= (new DateTime())->format('Y')?> The Vacation Channel. All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</footer>

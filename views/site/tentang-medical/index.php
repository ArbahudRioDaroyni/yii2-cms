<?php

use app\models\Lookup;
use app\models\Page;

$medical = Page::findOne(['id' => 35]);
?>
<div class="row service">
    <div class="tab-content service">
        <section id="services">  
            <div class="container services">
                <h4>TENTANG MEDICAL CHECKUP</h4>
                <div class="col-md-12 about-details">
                    <strong><?= Lookup::get('service-opening-1'); ?></strong>
                    <p><?= Lookup::get('service-opening-2'); ?></p>
                </div>
            </div>
        </section>
        <section class="col-md-12 outpatient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2 class="patient"><span class="tebal"><strong><?= $medical->title ?></strong></span></h2>
                            <div class="line-bottom"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel-group panel-outpatient" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel-body">
                                <div class="row">
                                    <?= $medical->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section></div>
</div>



<?php
use yii\widgets\ListView;
$this->title = 'Pencarian';
?>
<style>
.pagination{
    width: 100%;
    display: flex;
    flex-flow: wrap;
    margin-bottom: 30px;
}

.pagination li a{
    line-height: 30px;
    border: 1px solid transparent;
    text-align: center;
    color: #098b7a;
    transition: all 0.2s ease-in-out;
    text-transform: uppercase;
    padding: 8px;
}
.pagination li a:hover, .pagination li a:active{
    background: #098b7a;
    color: #fff;
    border-color: #000;
    text-decoration: none;
}
.pagination li span{
    display: none;
}
</style>

<section id="find-doctor-center" class="fdc-sec">
	<div class="container" style="max-width:1180px;">
		<div class="doctor-card-sec">
            <?php
            if ( isset($_GET['category']) ) {
                if ($_GET['category']=='doctors') { ?>
                    <h3>Dokter</h3>
                <?php }
                elseif ($_GET['category']=='articles') { ?>
                    <h3>Artikel Klinis</h3>
                <?php }
            }
            ?>
            <div class="result-notif">
                <?php if ( isset($_GET['category']) ) {
                        if ($_GET['category']=='doctors') { ?>
                <p>Kami menemukan <strong><?= count($doctors->getModels()) ?></strong> dokter spesialisasi</p>
                <?php } elseif ($_GET['category']=='articles') { ?>
                <p>Kami menemukan <strong><?= count($articles->getModels()) ?></strong> artikel</p>
                <?php } } ?>
            </div>
                <?php
                if ( isset($_GET['category']) ) {
                    if ($_GET['category']=='doctors') {
                        echo ListView::widget( [
                            'summary' => '',
                            'options' => ['class'=>'doctor-card-wrapper'],
                            'itemOptions' => [
                                'tag' => null
                            ],
                            'dataProvider' => $doctors,
                            'itemView' => '_doctors',
                            // Customzing Pagination
                            'pager' => [
                                'firstPageLabel' => 'first',
                                'lastPageLabel' => 'last',
                                'prevPageLabel' => 'previous',
                                'nextPageLabel' => 'next',
                                'maxButtonCount' => 5,

                                'options' => [
                                    'tag' => 'div',
                                    'class' => 'pagination',
                                    'id' => 'pager-container',
                                ],
                                
                                // Customzing CSS class for pager link
                                'linkOptions' => [
                                    'tag' => 'span',
                                    'class' => 'link'
                                ],
                                'activePageCssClass' => 'myactive',
                                'disabledPageCssClass' => 'mydisable',
                                
                                // Customzing CSS class for navigating link
                                'prevPageCssClass' => 'mypre',
                                'nextPageCssClass' => 'mynext',
                                'firstPageCssClass' => 'myfirst',
                                'lastPageCssClass' => 'mylast',
                            ],
                        ] );
                    }
                    elseif ($_GET['category']=='articles') {
                        echo ListView::widget( [
                            'summary' => '',
                            'options' => ['class'=>'doctor-card-wrapper'],
                            'itemOptions' => [
                                'tag' => null
                            ],
                            'dataProvider' => $articles,
                            'itemView' => '_articles',
                            // Customzing Pagination
                            'pager' => [
                                'firstPageLabel' => 'first',
                                'lastPageLabel' => 'last',
                                'prevPageLabel' => 'previous',
                                'nextPageLabel' => 'next',
                                'maxButtonCount' => 5,

                                'options' => [
                                    'tag' => 'div',
                                    'class' => 'pagination',
                                    'id' => 'pager-container',
                                ],
                                
                                // Customzing CSS class for pager link
                                'linkOptions' => [
                                    'tag' => 'span',
                                    'class' => 'link'
                                ],
                                'activePageCssClass' => 'myactive',
                                'disabledPageCssClass' => 'mydisable',
                                
                                // Customzing CSS class for navigating link
                                'prevPageCssClass' => 'mypre',
                                'nextPageCssClass' => 'mynext',
                                'firstPageCssClass' => 'myfirst',
                                'lastPageCssClass' => 'mylast',
                            ],
                        ] );
                    }
                }
                ?>
        </div>
    </div>
</section>
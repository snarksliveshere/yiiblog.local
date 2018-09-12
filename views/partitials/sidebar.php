<?php
use yii\helpers\Url;
?>
<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
            <?foreach ($popularPosts as $popularPost) :?>
                <div class="popular-post">
                    <a href="<?= Url::toRoute(['site/view', 'id' => $popularPost->id])?>" class="popular-img"><img src="<?=$popularPost->getImage()?>" alt="<?=$popularPost->title?>">
                        <div class="p-overlay"></div>
                    </a>
                    <div class="p-content">
                        <a href="<?= Url::toRoute(['site/view', 'id' => $popularPost->id])?>" class="text-uppercase"><?=$popularPost->title?></a>
                        <span class="p-date"><?=$popularPost->getDate()?></span>
                    </div>
                </div>
            <?endforeach;?>


        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
            <?foreach ($recentPosts as $recentPost):?>
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="<?= Url::toRoute(['site/view', 'id' => $recentPost->id])?> class="popular-img"><img src="<?=$recentPost->getImage()?>" alt="<?=$recentPost->title?>">
                            <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="<?= Url::toRoute(['site/view', 'id' => $recentPost->id])?>" class="text-uppercase"><?=$recentPost->title?></a>
                            <span class="p-date"><?=$recentPost->getDate()?></span>
                        </div>
                    </div>
                </div>
            <?endforeach;?>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <?foreach ($categories as $category):?>
                    <li>
                        <a href="<?= Url::toRoute(['site/category', 'id' => $article->category->id]) ?>"><?=$category->title?></a>
                        <span class="post-count pull-right"> (<?= $category->getArticlesCount()?>)</span>
                    </li>
                <?endforeach;?>

            </ul>
        </aside>
    </div>
</div>
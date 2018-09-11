<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($articles as $article) :?>
                    <article class="post">
                        <div class="post-thumb">
                            <a href="blog.html"><img src="<?= $article->getImage() ?>" alt=""></a>

                            <a href="blog.html" class="post-thumb-overlay text-center">
                                <div class="text-uppercase text-center">View Post</div>
                            </a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h6><a href="#"><?= $article->category->title?></a></h6>

                                <h1 class="entry-title"><a href="blog.html"><?= $article->title?></a></h1>


                            </header>
                            <div class="entry-content">
                                <p><?= $article->description?></p>

                                <div class="btn-continue-reading text-center text-uppercase">
                                    <a href="blog.html" class="more-link">Continue Reading</a>
                                </div>
                            </div>
                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By <a href="#">Rubel</a> On <?= $article->getDate()?></span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $article->viewed?>
                                </ul>
                            </div>
                        </div>
                    </article>
                <?php endforeach;?>

                <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination])?>
            </div>
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">

                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
                        <?foreach ($popularPosts as $popularPost) :?>
                            <div class="popular-post">
                                <a href="#" class="popular-img"><img src="<?=$popularPost->getImage()?>" alt="<?=$popularPost->title?>">
                                    <div class="p-overlay"></div>
                                </a>
                                <div class="p-content">
                                    <a href="#" class="text-uppercase"><?=$popularPost->title?></a>
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
                                        <a href="#" class="popular-img"><img src="<?=$recentPost->getImage()?>" alt="<?=$recentPost->title?>">
                                            <div class="p-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="p-content">
                                        <a href="#" class="text-uppercase"><?=$recentPost->title?></a>
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
                                    <a href="#"><?=$category->title?></a>
                                    <span class="post-count pull-right"> (<?= $category->getArticlesCount()?>)</span>
                                </li>
                            <?endforeach;?>

                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
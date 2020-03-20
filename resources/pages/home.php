<?php
/**
 * @var array $data
 */

use App\System\Auth;

$user = Auth::getUser();
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="news-search">
                <h1 style="float: left; font-weight: 900; font-size: 60px; line-height: 60px; letter-spacing: 0.416667px;
                color: #262626;">News</h1>
                <form action="" method="get" id="searchform">
                    <input type="text" placeholder="Search the site...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($data['articles'] as $article):
            $date = strtotime($article['date']);
            $date = date('d.m.Y', $date); ?>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="card-deck">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/articles/view/?id=<?= $article['id']; ?>" id="home-btn">
                                    <?= $article['title']; ?></a></h5>
                            <small class="text-muted"><?= $date; ?></small>
                            <?php
                            if ($article['images']): ?>
                                <div class="image">
                                    <img src="/images/<?= $article['images'][0]['path']; ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

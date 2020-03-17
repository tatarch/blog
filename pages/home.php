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
            <!-- у тебя дублируется этот кусок кода с меню. вынеси это в default.php или придумай другое решение если это не подходит -->

            <div class="news-search">
                <h1 style="float: left; font-weight: 900; font-size: 60px; line-height: 60px; letter-spacing: 0.416667px;
                color: #262626;">News</h1>
                <form action="" method="get" id="searchform">
                    <input type="text" placeholder="Search the site...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        <div class="card-deck">
             <?php foreach ($data as $article):
                 $date = strtotime($article['date']);
                 $date = date('d.m.Y', $date); ?>
             <!-- прикольный класс my-3 -->
                 <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/articles/view/?id=<?= $article['id']; ?>" id="home-btn">
                            <?= $article['title']; ?></a></h5>
                        <small class="text-muted"><?= $date; ?></small>
                        <?php // if ($article['images']
                        if ($article['images'] != null): ?>
                        <div class="image">
                            <img src="/images/<?= $article['images'][0]['path']; ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
             <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

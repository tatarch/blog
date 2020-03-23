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
                <h3>Result of your search</h3>
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

                            <?php foreach ($article['tags'] as $tag): ?>
                                <span class="tag tag-success"><?= $tag['name']; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
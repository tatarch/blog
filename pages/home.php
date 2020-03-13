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

            <header>
                <nav class="nav-nav">
                    <a class="logo" href="">
                        <span>L</span>
                        <span>O</span>
                        <span>G</span>
                        <span>O</span>
                    </a>
                    <div class="nav-toggle"><span></span></div>
                    <ul id="menu">
                       <?php if (!isset($user)): ?>
                           <li><a href="/users/form" id="menu-unregistered">Registration</a></li>
                           <li>or</li>
                           <li><a href="/users/loginForm" id="menu-unregistered">log in</a></li>
                       <?php endif; ?>
                        <?php if (isset($user)): ?>
                            <li> <a href="/articles/form" class="btn  btn-sm" id="menu-adding">Add article</a></li>
                            <li> <a href="/users/logout" class="btn  btn-sm" id="menu-exit">Exit</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </header>

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
                 <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/articles/view/?id=<?= $article['id']; ?>" id="home-btn">
                            <?= $article['title']; ?></a></h5>
                        <small class="text-muted"><?= $date; ?></small>
                        <?php if ($article['images'] != null): ?>
                        <div class="image">
                            <img src="/images/<?= $article['images'][0]; ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
             <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

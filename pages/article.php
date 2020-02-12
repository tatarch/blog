<?php
/**
 * @var array $data
 */
// форматируй код
use App\System\Auth;
use App\Repositories\ArticlesLikesRepository;

?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $data['title']; ?></h1>
            <p><?= $data['text']; ?></p>
            <?php if ($data['image'] != null): ?>
                <p><img src="/images/<?= $data['image']; ?>" class="img-fluid"></p>
            <?php endif; ?>


            <div class="divLike">
                <button class="js-buttonLike" name="like" data-id="<?= $data['id'] ?>">  <?php $user = Auth::getUser();
                    $userId = $user['id'];
                    $articleId = $data['id'];
                    // подготовь массив $data, сделай ему ключ 'isLiked' и заполни его выше, не во вьюхе
                    // вьюшка не должна работать с репозиторием. ее задача - от образить то что в нее передали
                    // тебе навернео кажется что это не важно и можно на это забить как для первого проекта
                    // сори но я так не считаю
                    $articlesLikesRepository = new ArticlesLikesRepository();
                    $isLiked = Auth::getUser() ? $articlesLikesRepository->isLiked($articleId, $userId) : false;
                    if ($isLiked != true): ?>
                        <i class=" heartLike far fa-heart" aria-hidden="true"></i>
                    <?php else: ?> <i class=" heartLike fas fa-heart" name="iLiked" aria-hidden="true"></i>
                    <?php endif; ?>
                </button>
                <span class="counter" data-id="<?= $data['id'] ?>"><?= $data['likesCount']; ?></span>
            </div>

            <form action="/articles/delete/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <!-- типографическая ошибка. тебе пхпшторм подчеркивает, посмотри почему -->
                <button type="submit" class="btn btn-danger">Deleta article</button>
            </form>

            <form action="/articles/form/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-warning my-3">Update article</button>
            </form>

        </div>
    </div>
</div>

<?php
/**
 * @var array $data
 */

use App\System\Auth;

$user = Auth::getUser();
?>
<?php foreach ($data['article']['comments'] as $comment):
    $date = strtotime($comment['date']);
    $date = date('d.m.Y', $date); ?>
    <div class="comment">
        <div class="card-comment">
            <div class="card-body">
                <?php if ($user['admin']): ?>
                    <span data-id='<?= $comment['id']; ?>'><i class="fas fa-times fa-2x"></i></span>
                <?php endif; ?>
                <h5 class="card-title"><?= $comment['user_name']; ?></h5>
                <p class="card-text"><?= $comment['body']; ?> </p>
            </div>
            <div class="card-footer">
                <small class="text-muted"><?= $date; ?></small>
            </div>
        </div>
    </div>
<?php endforeach; ?>

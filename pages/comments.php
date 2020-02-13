<?php
/**
 * @var array $data
 */
?>
<?php foreach ($data['comments'] as $comm):
    $date = strtotime($comm['date']);
    $date = date('d.m.Y', $date); ?>
    <div class="comment-wrapper">
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title"><?= $comm['user_name']; ?></h5>
                <p class="card-text"><?= $comm['body']; ?> </p>
            </div>
            <div class="card-footer">
                <small class="text-muted"><?= $date; ?></small>
            </div>
        </div>
    </div>
<?php endforeach; ?>

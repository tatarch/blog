<?php
/**
 * @var array $data
 */
?>
<?php
// ну можно было уж дописать 3 буквы в названии переменной)
foreach ($data['article']['comments'] as $comm):
    $date = strtotime($comm['date']);
    $date = date('d.m.Y', $date); ?>
    <div class="comment">
        <div class="card-comment">
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

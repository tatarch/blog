<?php
/**
 * @var array $data
 */
$articlesTags = array_column($data['article']['tags'], 'name');
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div id="form-title">
                <h1 id="form-title-h1">New note</h1>
            </div>
            <form action="/articles/save" method="post" class="articles-form" enctype="multipart/form-data">
                <input type="hidden" id="articleId" name="articleId"
                       data-id="<?= isset($data['article']['id']) ? $data['article']['id'] : "" ?>"
                       value="<?= isset($data['article']['id']) ? $data['article']['id'] : "" ?>">
                <div class="form-group row">
                    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="inputTitle"
                               value="<?= isset($data['article']['title']) ? $data['article']['title'] : "" ?>"
                               placeholder="Enter title">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputText" class="col-sm-2 col-form-label">Text</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="text" id="inputText" rows="6"
                                  placeholder="Enter text"><?= isset($data['article']['text']) ? $data['article']['text'] : "" ?></textarea>
                    </div>
                </div>

                <?php if (!empty($data['article']['images'])): ?>
                    <?php foreach ($data['article']['images'] as $image): ?>
                        <div class="form-images">
                            <input type="hidden" id="imageId"
                                   data-id="<?= $image['id']; ?>" value="<?= $image['id']; ?>">
                            <img src="/images/<?= $image['path']; ?>" class="form-image">
                            <span data-id='<?= $image['path']; ?>'><i class="fas fa-times fa-2x"></i></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <input type="file" name="file[]" multiple>

                <div class="demo">
                    <div class="control-group">
                        <label for="select-beast">Tags:</label>
                        <select id="select-beast" class="demo-default" name="tags[]" multiple>
                            <option value="">Select tags...</option>
                            <?php if (!empty($data['tags'])): ?>
                                <?php foreach ($data['tags'] as $tag): ?>
                                    <option value="<?= $tag; ?>" <?= in_array($tag, $articlesTags)? "selected" : "" ?>><?= $tag; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input id="datepicker" name="date"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" id="form-btn">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


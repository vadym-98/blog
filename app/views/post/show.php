<section class="post-page">
    <div class="posts">
        <div class="d-flex justify-content-center">
            <img src="<?= $post[0]['image'] ?>" alt="image" class="big-image">
        </div>
        <h1 class="post-title"><?= $post[0]['title'] ?></h1>
        <p><?= $post[0]['content'] ?></p>
        <div class="tags d-flex">
            <?php if (!empty($post[0]['tags'])): ?>
                <form action="/tags" method="post">
                    <?php foreach (explode(',', $post[0]['tags']) as $tag): ?>
                        <button class="tag" value="<?= '#' . $tag ?>" name="tag"><?= '#' . $tag ?></button>
                    <?php endforeach; ?>
                </form>
            <?php endif; ?>
        </div>
        <p class="text-black-50 py-2">written by <span class="text-secondary"><?= $user['username'] ?></span></p>
    </div>
    <div class="form-comment">
        <form
                action="/comment/create"
                method="post"
                class="d-flex justify-content-start align-items-end"
                id="commentForm">
            <textarea name="comment" id="comment" placeholder="Comment it" class="form-control"></textarea>
            <div hidden id="postId"><?= $post[0]['id'] ?></div>
<!--            <div class="down btn btn-success">Вниз</div>-->
            <button type="submit" class="btn btn-primary comment-btn submit">Отправить</button>
        </form>
    </div>
    <div class="comments py-3">
        <?php foreach ($comments as $comment): ?>
            <div class="py-2 comment">
                <div class="d-flex justify-content-between">
                    <p class="m-0 text-secondary small-text"><?= $comment['user_mail'] ?></p>
                    <p class="m-0 text-secondary small-text"><?= $comment['created'] ?></p>
                </div>
                <p class="m-0"><?= $comment['content'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="position-bottom"></div>
</section>
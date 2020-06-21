<section>
    <div class="posts">
        <?php foreach ($posts as $post): ?>
            <?php if ($post['status'] !== 'closed' || $post['user_id'] === $_SESSION['user']): ?>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="post/show/<?= $post['id'] ?>" class="d-flex py-3 align-items-center">
                        <img src="<?= $post['image'] ?>" alt="image" class="image">
                        <div class="title">
                            <div class="d-flex">
                                <h3><?= $post['title'] ?></h3>
                                <?php if ($post['status'] === 'new'): ?>
                                    <p class="small-text ml-1"><?= $post['status'] ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="tags d-flex">
                                <?php if (!empty($post['tags'])): ?>
                                    <?php foreach (explode(',', $post['tags']) as $tag): ?>
                                        <p class="tag"><?= '#' . $tag ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                    <?php if ($_SESSION['user'] === $post['user_id']): ?>
                        <div class="d-flex">
                            <a href="post/edit/<?= $post['id'] ?>" class="btn btn-primary">
                                Edit
                            </a>
                            <form action="post/delete/<?= $post['id'] ?>" method="post" class="ml-1">
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
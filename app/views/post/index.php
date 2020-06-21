<section>
    <div class="posts">
        <?php foreach ($posts as $post): ?>
            <div class="d-flex align-items-center justify-content-between">
                <a href="post/show/<?= $post['id'] ?>" class="d-flex py-3 align-items-center">
                    <img src="<?= $post['image'] ?>" alt="image" class="image">
                    <div class="title">
                        <h3><?= $post['title'] ?></h3>
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
        <?php endforeach; ?>
    </div>
</section>
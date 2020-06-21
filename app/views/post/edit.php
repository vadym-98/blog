<div class="jumbotron my-4 col-5 mx-auto py-4">
    <h4 class="offset-4">Edit Post</h4>
    <form action="/post/update" method="post" id="userForm" enctype="multipart/form-data">
        <div class="form-group row align-items-center">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-9 offset-1">
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    id="title"
                    value="<?= $post[0]['title'] ?>">
            </div>
            <div hidden><?= $post[0]['id'] ?></div>
        </div>
        <div class="form-group row align-items-center">
            <label for="content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-9 offset-1">
                <textarea
                    type="text"
                    name="content"
                    class="form-control"
                    id="content"><?= $post[0]['content'] ?></textarea>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-9 offset-1">
                <select class="form-control" id="status" name="status">
                    <option value="new" <?php if ($post[0]['status'] === 'new') echo 'selected'; ?>>new</option>
                    <option value="open" <?php if ($post[0]['status'] === 'open') echo 'selected'; ?>>open</option>
                    <option value="closed" <?php if ($post[0]['status'] === 'closed') echo 'selected'; ?>>closed</option>
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="tags" class="col-sm-2 col-form-label">Tags</label>
            <div class="col-sm-9 offset-1">
                <select multiple class="form-control" id="tags" name="tags">
                    <?php foreach ($tags as $tag): ?>
                        <option value="<?= $tag['id'] ?>"
                            <?php if (in_array($tag['name'], explode(',', $post[0]['tags']))) echo 'selected';?>>
                            <?= $tag['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="/" class="btn btn-danger">Cancel</a>
            <button type="submit"
                    class="btn btn-success offset-1 submit">
                Submit
            </button>
        </div>
    </form>
</div>
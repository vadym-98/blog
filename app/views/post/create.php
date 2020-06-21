<div class="jumbotron my-4 col-5 mx-auto py-4">
    <h4 class="offset-4">Add Post</h4>
    <form action="/post/add" method="post" id="userForm" enctype="multipart/form-data">
        <div class="form-group row align-items-center">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-9 offset-1">
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    id="title">
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-9 offset-1">
                <textarea
                    type="text"
                    name="content"
                    class="form-control"
                    id="content"></textarea>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-9 offset-1">
                <select class="form-control" id="status" name="status">
                    <option value="new" selected>new</option>
                    <option value="open">open</option>
                    <option value="closed">closed</option>
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="tags" class="col-sm-2 col-form-label">Tags</label>
            <div class="col-sm-9 offset-1">
                <select multiple class="form-control" id="tags" name="tags">
                    <?php foreach ($tags as $tag): ?>
                        <option value="<?= $tag['id'] ?>" <?php if ($tag['name'] === 'new') echo 'selected';?>>
                            <?= $tag['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="image" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-9 custom-file">
                <input type="file" class="custom-file-input" id="image" name="image">
                <label class="custom-file-label offset-2" for="customFile">image</label>
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
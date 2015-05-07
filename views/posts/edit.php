<div class="row login">
    <div class="col-md-2"></div>
    <div class="col-md-10">
    <h3>Edit Existing Post</h3>
    <?php if ($this->post) { ?>
        <form method="post" action="/posts/edit/<?= $this->post['id'] ?>">
            Title:
            <textarea name="title" maxlength="200" cols="100" rows="2"><?= htmlspecialchars($this->post['title']) ?></textarea>
            Text:
            <textarea name="text" maxlength="5000" cols="100" rows="20"><?= htmlspecialchars($this->post['text']) ?></textarea>
            <input type="submit" value="Edit" class="submit-button"/>
            <a href="/posts" class="cancel-link">Cancel</a>
        </form>
    <?php } ?>
    </div>
</div>



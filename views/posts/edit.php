<div class="row edit">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <h3>Edit Existing Post</h3>
        <?php if ($this->post) { ?>
            <form method="post" action="/posts/edit/<?= $this->post['id'] ?>">
                <div class="col-md-12 tRow">
                    <label for="title" class="col-md-1">Title:</label>
                    <textarea name="title" maxlength="200" cols="100" rows="2"
                              class="col-md-10" id="title"><?= htmlspecialchars($this->post['title'])?></textarea>
                </div>
                <div class="col-md-12 tRow">
                    <label for="text" class="col-md-1">Text:</label>
                    <textarea name="text" maxlength="5000" cols="100" rows="20"
                              class="col-md-10" id="text"><?= htmlspecialchars($this->post['text']) ?></textarea>
                </div>
                <div class="col-md-12 tRow">
                    <label for="tags" class="col-md-1">Tags:</label>
                    <textarea name="tags" maxlength="100" cols="100" rows="2"
                              class="col-md-10" id="tags"><?php for ($i = 0; $i < count($this->tags); $i++) {
                            echo htmlspecialchars($this->tags[$i]['tag']);
                            echo ' ';
                        } ?>
                    </textarea>
                </div>
                <div class="col-md-12 col-md-offset-1">
                    <input type="submit" value="Edit" class="submit-button"/>
                    <a href="/posts" class="cancel-link">Cancel</a>
                </div>
            </form>
            <div class="col-md-12 tRow">
                <form method="POST" action="/posts/deleteTagsFromPost/<?= $this->post['id'] ?>">
                    <label for="remove-tags" class="col-md-1">Remove tags:</label>
                    <input type="text" class="col-md-9" name="remove-tags" id="remove-tags" placeholder="Enter tags, separated by space:"/>
                    <input type="submit" value="Remove" class="submit-button"/>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
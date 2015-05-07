<?php $post = $this -> post ?>
<div class="row read-post" >
        <div class="col-md-9 col-md-offset-2">
            <div class="read-post-date">
                <?= htmlspecialchars($this->post['date'])?>
            </div>
            <div class="read-post-title">
                <?= htmlspecialchars($this->post['title']) ?>
            </div>
            <div class="read-post-body">
                <?= htmlspecialchars($this->post['text']) ?>
            </div>
            <form method="post" action= "/read/comment/<?=$post['id']?>">
            <textarea class="leave-comment" name="comment" maxlength="5000" cols="100" rows="5" placeholder="Leave a comment..."></textarea>
            <input type="submit" value="Comment" class="submit-button"/>
            </form>
            <?php foreach($this->comments as $comment): ?>
                <div class="read-comment-info">
                    <?= htmlspecialchars($comment['date']).' by ' .htmlspecialchars($comment['username'])?>
                </div>
                <div class="read-comment-body">
                    <?= htmlspecialchars($comment['comment']) ?>
                </div>
            <?php endforeach?>
    </div>
</div>
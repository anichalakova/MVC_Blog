<?php $post = $this -> post ?>
<div class="row read-post" >
        <div class="col-md-9 col-md-offset-2">
            <div class="read-post-info col-md-12">
                <div class="read-post-date col-md-6">
                    <?= htmlspecialchars($this->post['date'])?>
                </div>
                <div class="read-post-visits col-md-2 col-md-offset-4">
                    <?= 'Visited: '.htmlspecialchars($this->post['visits'])?>
                </div>
            </div>
            <div class="read-post-title">
                <?= htmlspecialchars($this->post['title']) ?>
            </div>
            <div class="read-post-body">
                <?= htmlspecialchars($this->post['text']) ?>
            </div>
            <form method="post" action= "/read/comment/<?=$post['id']?>">
                <textarea class="leave-comment" name="comment" maxlength="5000" cols="100" rows="5" placeholder="Leave a comment..."></textarea>
                <?php if (!($this->isLoggedIn())):?>
                    <div class="col-md-12 comment-credentials">
                        <input type="text" name="name" placeholder="Enter your name to comment" class="col-md-5 comment-name"/>
                        <input type="email" name = "e-mail" placeholder="E-mail (optional)" class="col-md-5 col-md-offset-1 comment-email"/>
                    </div>
                <?php endif ?>
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
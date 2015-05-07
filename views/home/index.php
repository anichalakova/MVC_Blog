<div class="row home-posts" >
<?php foreach ($this->posts as $post) : ?>
        <form method="GET" action = "/read/index/<?=$post['id']?>";>
            <div class="col-md-6 col-md-offset-3">
                <div class="home-post-date">
                    <?= htmlspecialchars($post['date'])?>
                </div>
                <div class="home-post-title">
                    <?= htmlspecialchars($post['title']) ?>
                </div>
                <div class="home-post-body">
                    <?= htmlspecialchars($post['text']) ?>
                </div>
                <input type="submit" value="Read more" class="read-more"/>
            </div>
        </form>
<?php endforeach ?>
</div>
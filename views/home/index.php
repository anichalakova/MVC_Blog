<div class="row home-posts" >
    <div class="col-md-9 col-md-offset-2">
        <?php foreach ($this->posts as $post) : ?>
                <form method="GET" action = "/read/index/<?=$post['id']?>";>
                    <div class="col-md-12 home-post-info">
                        <div class="read-post-date col-md-6">
                            <?= htmlspecialchars($post['date'])?>
                        </div>
                        <div class="home-post-visits col-md-2 col-md-offset-4">
                            <?= 'Visited: '.htmlspecialchars($post['visits'])?>
                        </div>
                    </div>
                    <div class="home-post-title">
                        <?= htmlspecialchars($post['title']) ?>
                    </div>
                    <div class="home-post-body">
                        <?= htmlspecialchars($post['text']) ?>
                    </div>
                    <div class="home-post-tags">
                    <p>Tags: </p>
                    <?php for ($i = 0; $i < count($post['tags']); $i++) {
                        echo htmlspecialchars($post['tags'][$i]['tag']);
                        echo ' ';
                    } ?>
                    </div>
                    <input type="submit" value="Read more" class="submit-button"/>
                </form>
        <?php endforeach ?>
        <div class="col-md-12 pagination">
            <?php  if ($this->page>1):?>
                <a href="home/index/<?= $this->page-1?>/<?= $this->pageSize?>/">Previous</a>
            <?php endif ?>
            <?php  if ($this->pageSize*($this->page) <$this->totalpostsNumber):?>
                <a href="/home/index/<?= $this->page+1?>/<?= $this->pageSize?>/">Next</a>
            <?php endif ?>
        </div>
    </div>
</div>
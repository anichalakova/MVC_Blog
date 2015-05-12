<div class="row my-posts" >
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <h3>My posts</h3>
        <div class="col-md-12" id="create-new">
            <a href="/posts/create">[Create New]</a>
        </div>
        <table id="my-posts" class="col-md-11">
            <tr>
                <th>DB Id</th>
                <th>Date</th>
                <th>Title</th>
                <th>Text</th>
                <th colspan="2">Action</th>
            </tr>
            <?php foreach ($this->posts as $post) : ?>
                <tr>
                    <td><?= htmlspecialchars($post['id'])?></td>
                    <td><?= htmlspecialchars($post['date'])?></td>
                    <td class="col-md-3"><div><?= htmlspecialchars($post['title']) ?></div></td>
                    <td class="col-md-5"><div><?= htmlspecialchars($post['text']) ?></div></td>
                    <td><a href="/posts/edit/<?=$post['id'] ?>">[Edit]</td>
                    <td><a href="/posts/delete/<?=$post['id'] ?>">[Delete]</td>
                </tr>
            <?php endforeach ?>
        </table>
        <div class="col-md-12 pagination">
            <?php  if ($this->page>1):?>
                <a href="/posts/index/<?= $this->page-1?>/<?= $this->pageSize?>/">Previous</a>
            <?php endif ?>
            <?php  if ($this->pageSize*($this->page) <$this->totalpostsNumber):?>
                <a href="/posts/index/<?= $this->page+1?>/<?= $this->pageSize?>/">Next</a>
            <?php endif ?>
        </div>

    </div>
</div>


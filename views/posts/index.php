<div class="row my-posts" >
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <h3>My posts</h3>
        <table id="my-posts">
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
                    <td><?= htmlspecialchars($post['title']) ?></td>
                    <td><?= htmlspecialchars($post['text']) ?></td>
                    <td><a href="/posts/edit/<?=$post['id'] ?>">[Edit]</td>
                    <td><a href="/posts/delete/<?=$post['id'] ?>">[Delete]</td>
                </tr>
            <?php endforeach ?>
            <?php  if ($this->page>1):?>
                <a href="/posts/index/<?= $this->page-1?>/<?= $this->pageSize?>/">Previous</a>
            <?php endif ?>
            <?php  if ($this->pageSize*($this->page) <$this->totalpostsNumber):?>
                <a href="/posts/index/<?= $this->page+1?>/<?= $this->pageSize?>/">Next</a>
            <?php endif ?>
        </table>
        <a href="/posts/create">[Create New]</a>
    </div>
</div>


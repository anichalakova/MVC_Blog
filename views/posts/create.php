<div class="row create">
    <div class="col-md-2"></div>
    <div class="col-md-10">
        <h3>Create New Post</h3>
        <form method="post" action="/posts/create" class="row">
            <div class="col-md-12">
                <input type="text" name="title" placeholder="Enter title..." class="col-md-11"/>
            </div>
            <div class="col-md-12">
                <textarea name="text" placeholder="Enter text..." class="col-md-11"></textarea>
            </div>
            <div class="col-md-12">
                <textarea name="tags" placeholder="Enter tags, separated by space:" class="col-md-11"></textarea>
            </div>
            <div class="col-md-12">
                <input type="submit" value="Create" class="submit-button">
                <a href="/posts" class="cancel-link">Cancel</a>
            </div>
        </form>
    </div>
</div>


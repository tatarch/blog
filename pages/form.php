
<div class="container">
    <div class="row">
        <div class="col">
            <div  id="form-title">
                <h1 id="form-title-h1">New note</h1>
            </div>
            <form action="/articles/save" method="post" class="articles-form">
                <div class="form-group row">
                    <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="usertitle" id="inputTitle" placeholder="Enter title">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputText" class="col-sm-2 col-form-label">Text</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="usertext" id="inputText" rows="6" placeholder="Enter text"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" id="form-btn">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

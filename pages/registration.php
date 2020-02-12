<div class="container">
    <div class="row">
        <div class="col">
            <form action="/users/save" method="post" class="users-form">
                <div class="form-group ">
                    <label for="inputEmail1">Email address</label>
                    <input type="email" class="form-control" name="useremail" id="inputEmail1"
                           placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" name="username" id="inputName" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" name="userpassword" id="inputPassword"
                           placeholder="Enter password">
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="inputCheck">
                    <label class="form-check-label" for="inputCheck">Check me out</label>
                </div>

                <button type="submit" class="btn btn-primary">Register Now</button>
            </form>
        </div>
    </div>
</div>

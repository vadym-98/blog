<section>
    <div class="d-flex justify-content-center align-items-center form">
        <form action="/auth" method="post" id="userForm">
            <div class="form-group">
                <h3 class="py-3">Login Form</h3>
                <div><label for="name">Login</label></div>
                <div class="py-2"><input type="text" id="login" class="form-control" name="login"></div>
                <div><label for="password">Password</label></div>
                <div class="py-2"><input type="password" id="password" class="form-control" name="password"></div>
                <input type="submit" class="btn btn-primary submit" value="Login">
                <a href="/register" class="btn btn-primary">Register</a>
            </div>
        </form>
    </div>
</section>

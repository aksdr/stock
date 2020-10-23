<form action="register.php" method="post">
    <fieldset >
        <div class="form-group" id="middle">
            <input autocomplete="off" autofocus class="form-control" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group" id="middle">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
            <br>
            Confirm your password <br>
            <input class="form-control" name="confirmation" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Register
            </button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">log in</a> for an account
</div>

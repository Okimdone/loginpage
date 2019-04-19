<!doctype html>
<html>
    <head>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <h1>Login</h1>
            <div>
                <form action="/login" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="uname" id="uname"> <br>
                    <input type="password" name="password" id="password"> <br>
                    <button type="submit">submit</button>
                </form>
            </div>
        </div>
    </body>
</html>

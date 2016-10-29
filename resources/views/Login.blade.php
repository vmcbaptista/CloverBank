<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    <body>
        <h1> Login </h1>
        <br>
        <form action="LoginData" method="post">
                <fieldset>
                    Username:
                    <br>
                    <input type="text" name="Username" required>
                    <br>
                    Password:
                    <br>
                    <input type="password" name="Password" required>
                    <input type="Submit" value="Submit">
                    <?php
                    echo '<input type="hidden" name="_token" value="'.csrf_token().'">';

                    ?>
                </fieldset>
        </form>
    </body>
</html>



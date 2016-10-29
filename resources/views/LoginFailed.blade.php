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

        <?php

            switch($ErrorLogin)
            {
                case 1:
                    echo "<p> A password encontra-se incorreta!</p>";

                    break;
                case 2:
                    echo "<p> O username que introduziu nao existe!</p>";

                    break;
                case 3:
                    echo "<p>O campo Username e/ou Password nao podem estar vazios </p>";

                    break;
                default:
                    break;
            }

        ?>
    </fieldset>
</form>
</body>











</html>



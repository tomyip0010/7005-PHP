<!DOCTYPE html>
<html>
    <head>
        <title>Greeting Form</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="greeting" method="post">
            {{ csrf_field() }}
            First name:<br>

            <input type="text" name="name"><br>

            Age:<br>

            <input type="text" name="age"><br><br>

            <input type="submit" value="Submit">
        </form> 
    </body>
</html>                                           
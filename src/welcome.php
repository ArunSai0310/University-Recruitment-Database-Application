<?php 
include "database/db_connection.php";

page_protect();


?>

<html>
<head>

    <title>
        Registration
    </title>
</head>

<body>
<h1>Welcome</h1><br>
<?php
echo $_SESSION['user_name'];
?>


<h1><a href="logout.php">Logout here</a> </h1>


</body>

</html>


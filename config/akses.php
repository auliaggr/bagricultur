<?php

    if(!isset($_SESSION['user'])){
        echo '<script language="javascript">
            alert("Anda harus Login!"); 
            document.location="login.php";</script>';
    }

?>
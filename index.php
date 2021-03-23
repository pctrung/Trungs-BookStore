<?php

    if (!isset($_SERVER['PATH_INFO']))
    {
        echo "Home page";
        exit();
    }

    print "The request path is : ".$_SERVER['PATH_INFO'];
?>
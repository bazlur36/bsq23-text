<?php
Class DbConnection{
    function getdbconnect(){
        $conn = mysqli_connect("localhost","root","root","ecommerce") or die("Couldn't connect");
        return $conn;
    }
}

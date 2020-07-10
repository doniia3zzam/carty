<?php

class database {
    var $con;
    function __construct(){

        $this->con=mysqli_connect("localhost","root","","cartyy");
    }
    function runDml($statement){
        if (!( mysqli_query($this->con,$statement))) {

           return mysqli_error($this->con);
        }
        else{
            return "ok";
        }
    }
    function checkData($select){
        $result = mysqli_query($this->con,$select);
        // if(mysqli_num_rows($result)>0){
            return $result;
        // }else{
        //     ;
        // }

    }
    function lastId(){
        return mysqli_insert_id($this->con);
    }
}

?>

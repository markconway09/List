<?php
function connect(){
    $connect= mysqli_connect("localhost", "root", "", "project");
    if(!$connect){
        die("Error connecting: ".mysqli_connect_error());
    }
    return $connect;
}

function disconnect($connection){
    mysqli_close($connection);
}

// SERIES

function selectMovies($watched){
    $c=connect();
    $select="select * from movies where m_watched=$watched order by m_name";
    $result= mysqli_query($c, $select);
    disconnect($c);
    return $result;
}

function insertMovies($name){
    $c=connect();
    $insert="insert into movies values('','$name',0)";
    if(mysqli_query($c,$insert)){
        $result=true;
    }else{
        $result= mysqli_error($c);
    }
    disconnect($c);
    return $result;
}

function watchedMovies($id,$watched){
    $c=connect();
    $select="update movies set m_watched=".(int)!$watched." where m_id='$id'";
    if(mysqli_query($c,$select)){
        $result=true;
    }else{
        $result= mysqli_error($c);
    }
    disconnect($c);
    return $result;
}

function deleteMovies($id){
    $c=connect();
    $insert="delete from movies where m_id='$id'";
    if(mysqli_query($c,$insert)){
        $result=true;
    }else{
        $result= mysqli_error($c);
    }
    disconnect($c);
    return $result;
}
//
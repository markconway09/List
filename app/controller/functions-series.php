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

function selectSeries($watched){
    $c=connect();
    $select="select * from series where s_watched=$watched order by s_name";
    $result= mysqli_query($c, $select);
    disconnect($c);
    return $result;
}

function insertSeries($name,$total){
    $c=connect();
    $insert="insert into series values('','$name','0','$total',0)";
    if(mysqli_query($c,$insert)){
        $result=true;
    }else{
        $result= mysqli_error($c);
    }
    disconnect($c);
    return $result;
}

function watchedSeries($id,$watched){
    $c=connect();
    $select="update series set s_watched=".(int)!$watched." where s_id='$id'";
    if(mysqli_query($c,$select)){
        $result=true;
    }else{
        $result= mysqli_error($c);
    }
    disconnect($c);
    return $result;
}

function deleteSeries($id){
    $c=connect();
    $insert="delete from series where s_id='$id'";
    if(mysqli_query($c,$insert)){
        $result=true;
    }else{
        $result= mysqli_error($c);
    }
    disconnect($c);
    return $result;
}

function plusEp($id,$p,$t,$watched){
    if($p+1 == $t) watchedSeries($id,$watched);
    $c=connect();
    $select="update series set progress=progress+1 where s_id='$id'";
    if(mysqli_query($c,$select)){
        $result=true;
    }else{
        $result= mysqli_error($c);
    }
    disconnect($c);
    return $result;
}

function minusEp($id,$p,$t,$watched){
    if($p == $t) watchedSeries($id,$watched);
    if(($p-1)<0){
        $result=true;
    }else{
        $c=connect();
        $select="update series set progress=progress-1 where s_id='$id'";
        if(mysqli_query($c,$select)){
            $result=true;
        }else{
            $result= mysqli_error($c);
        }
        disconnect($c);
    }
    return $result;
}
//
<?php
require_once CONTROLLER.'/functions-series.php';

$i=0;
$j=0;
$select=selectSeries(0);
$selectWatched=selectSeries(1);
?>
<div>
    <div class="mt-4">
        <h1 class='display-4 text-center text-light'>Series</h1>
        <div class="text-center">
            <form method="post">
                <input name='sName' type='text' placeholder='Name' required>
                <input name='sEps' type='number' min=1 placeholder='Total Episodes' required>
                <input class="btn-primary" type='submit' name='addSeries' value='Add'>
            </form>
        </div>
    <div>
    <div class="container-fluid"><div class="row">
        <div class="m-4 col">
            <h3 class="text-center text-white">In progress</h3>
            <table class='table table-striped table-dark'>
                <tr>
                    <th>#</th><th>Name</th><th>Progress</th><th>Delete</th>
                </tr>
                <tbody>
                <?php
                while($row= mysqli_fetch_assoc($select)){
                    echo"<tr>";
                    echo"<form action='' method='post'>";
                    echo"<td>".++$i."</td>";
                    echo"<td>".$row["s_name"]."</td>";
                    echo"<td><input class='btn btn-sm text-light' type='submit' name='minusEp' value='-'>".$row["progress"]."/".$row["total"]."<input class='btn btn-sm text-light' type='submit' name='plusEp' value='+'></td>";
                    echo"<td><input class='btn btn-sm btn-danger text-light' type='submit' name='deleteSeries' value='Delete'></td>";
                    echo"<input type='hidden' name='s_id' value='".$row["s_id"]."'>";
                    echo"<input type='hidden' name='progress' value='".$row["progress"]."'>";
                    echo"<input type='hidden' name='total' value='".$row["total"]."'>";
                    echo"<input type='hidden' name='s_watched' value='".$row["s_watched"]."'>";
                    echo"</form>";
                    echo"</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div id="watched-list" class="m-4 col">
            <h3 class="text-center text-white">Finished</h3>
            <table class='table table-striped table-dark'>
                <tr>
                    <th>#</th><th>Name</th><th>Progress</th><th>Delete</th>
                </tr>
                <tbody>
                <?php
                while($row= mysqli_fetch_assoc($selectWatched)){
                    echo"<tr>";
                    echo"<form action='' method='post'>";
                    echo"<td>".++$j."</td>";
                    echo"<td>".$row["s_name"]."</td>";
                    echo"<td><input class='btn btn-sm text-light' type='submit' name='minusEp' value='-'>".$row["progress"]."/".$row["total"]."</td>";
                    echo"<td><input class='btn btn-sm btn-danger text-light' type='submit' name='deleteSeries' value='Delete'></td>";
                    echo"<input type='hidden' name='s_id' value='".$row["s_id"]."'>";
                    echo"<input type='hidden' name='progress' value='".$row["progress"]."'>";
                    echo"<input type='hidden' name='total' value='".$row["total"]."'>";
                    echo"<input type='hidden' name='s_watched' value='".$row["s_watched"]."'>";
                    echo"</form>";
                    echo"</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php

if(isset($_POST["plusEp"])){
    plusEp($_POST["s_id"],$_POST["progress"],$_POST["total"],$_POST["s_watched"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST["minusEp"])){
    minusEp($_POST["s_id"],$_POST["progress"],$_POST["total"],$_POST["s_watched"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST["addSeries"])){
    insertSeries($_POST["sName"],$_POST["sEps"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST["deleteSeries"])){
    deleteSeries($_POST["s_id"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
<?php
require_once CONTROLLER.'/functions-movies.php';

$i=0;
$select=selectMovies(0);
$selectWatched=selectMovies(1);
?>
<div>
    <div class="mt-4">
        <h1 class='display-4 text-center text-light'>Movies</h1>
        <div class="text-center">
            <form method="post">
                <input name='mName' type='text' placeholder='Name' required>
                <input type='submit' name='addMovies' value='Add'>
            </form>
        </div>
    <div>
    <div class="container-fluid"><div class="row">
        <div class="m-4 col">
            <h3 class="text-center text-white">Not watched</h3>
            <table class='table table-striped table-dark'>
                <tr>
                    <th>#</th><th>Name</th><th>Progress</th><th>Watched?</th><th>Delete</th>
                </tr>
                <tbody>
                <?php
                while($row= mysqli_fetch_assoc($select)){
                    echo"<tr>";
                    echo"<form action='' method='post'>";
                    echo"<td>".++$i."</td>";
                    echo"<td>".$row["m_name"]."</td>";
                    echo"<td><input class='btn btn-sm text-light' type='submit' name='plusEp' value='+'></td>";
                    echo"<td><input class='btn btn-sm text-light' type='submit' name='watchedMovies' value='Watched'></td>";
                    echo"<td><input class='btn btn-sm text-light' type='submit' name='deleteMovies' value='Delete'></td>";
                    echo"<input type='hidden' name='m_id' value='".$row["m_id"]."'>";
                    echo"<input type='hidden' name='m_watched' value='".$row["m_watched"]."'>";
                    echo"</form>";
                    echo"</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="m-4 col">
            <h3 class="text-center text-white">Watched</h3>
            <table class='table table-striped table-dark'>
                <tr>
                    <th>#</th><th>Name</th><th>Watched?</th><th>Delete</th>
                </tr>
                <tbody>
                <?php
                while($row= mysqli_fetch_assoc($selectWatched)){
                    echo"<tr>";
                    echo"<form action='' method='post'>";
                    echo"<td>".++$i."</td>";
                    echo"<td>".$row["m_name"]."</td>";
                    echo"<td><input class='btn btn-sm text-light' type='submit' name='watchedMovies' value='Unwatch'></td>";
                    echo"<td><input class='btn btn-sm text-light' type='submit' name='deleteMovies' value='Delete'></td>";
                    echo"<input type='hidden' name='m_id' value='".$row["m_id"]."'>";
                    echo"<input type='hidden' name='m_watched' value='".$row["m_watched"]."'>";
                    echo"</form>";
                    echo"</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div></div>
</div>
<?php

if(isset($_POST["addMovies"])){
    insertMovies($_POST["mName"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST["watchedMovies"])){
    watchedMovies($_POST["m_id"],$_POST["m_watched"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST["deleteMovies"])){
    deleteMovies($_POST["m_id"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
<?php
 $link = mysqli_connect("localhost", "root", "", "course", 3306);

if(isset($_POST['data_event']))
{
    $sql = "SELECT * FROM Afisha where $_POST['data_event'] = min(data_start) and $_POST['data_event'] = max(data_start)";
}
else
    $sql = 'SELECT * FROM Afisha';

if ($result = mysqli_query($link, $sql))
{
    while( $row = mysqli_fetch_assoc($result) )
    {
        $res = array('data_start' => $row['data_start'], 'data_end' => $row['data_end']);
    }
    echo json_encode($res);
}
?>


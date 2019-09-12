<?php
    mysql_connect('localhost','root','usbw');
    mysql_select_db('batch');
    $id = $_GET['Id'];
    $query = "select * from batch where Id ='$id'";
    $query = mysql_query($query);
    while($row = mysql_fetch_array($query))
    {
        $path = $row['FinalPresTemplateFileName'];
        header('content = Disposition: attachment; filename ='.$path.'');
        header('content-type:appliction/cotent-strem');
        header('content-length ='.filesize($path));
        readfile($path);
    }
?>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


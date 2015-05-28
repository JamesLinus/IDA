<?php
    include($_SERVER['DOCUMENT_ROOT'].'/includes/dbconnect.php');
    include($_SERVER['DOCUMENT_ROOT'].'/includes/userdata.php');

    $mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbsel);
    $myArray = array();
    if ($result = $mysqli->query("SELECT  users . *, branch.FY_start, branch . branch ,  roles . role_name  
                    FROM branch LEFT JOIN  IDA . users  ON  branch . branchid  =  users . branchid  
                    LEFT JOIN  IDA . roles  ON  users . role_id  =  roles . roleID 
                    WHERE  users . role_id >= '". $rolelvl ."'")) {

        while($row = $result->fetch_array(MYSQL_ASSOC)) {
                $myArray['data'][] = $row;
        }
        $myArray['status'] = 'Success';
        echo json_encode($myArray);
    }

    $result->close();
    $mysqli->close();

?>
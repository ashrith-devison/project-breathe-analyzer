<?php
    require '../../../database.php';
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $request = file_get_contents("php://input");
        $request = json_decode($request,true);
        $department = $request['departmentId'];
        $shift = $request['shiftId'];
        $FromDate = $request['fromDate'];
        $ToDate = $request['toDate'];
        if($shift == 'All' && $department == 'All'){
            $sql = "SELECT * FROM final_attendence WHERE date BETWEEN '$FromDate' AND '$ToDate'";
        }else if($shift == 'All'){
            $sql = "SELECT * FROM final_attendence WHERE date BETWEEN '$FromDate' AND '$ToDate' AND department = $department";
        }else if($department == 'All'){
            $sql = "SELECT * FROM final_attendence WHERE date BETWEEN '$FromDate' AND '$ToDate' AND shift = '$shift'";
        }else{
            $department = intval($department);
            $sql = "SELECT * FROM final_attendence WHERE date BETWEEN '$FromDate' AND '$ToDate' AND shift = '$shift' AND department = $department";
        }
        $depts = "SELECT * FROM department";
        $depts = $conn->query($depts);
        $department = array();
        while($dept = $depts->fetch_assoc()){
            $department[$dept['Department_Id']] = $dept['Department_name'];
        }
        $result = $conn->query($sql);
        echo "<p id='close-button' class='text-end'><button class='btn btn-danger' onclick='closeTab();'>x</button></p>";
        echo "<table class='table'> ";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Employee ID</th>";
        echo "<th>Employee Name</th>";
        echo "<th>Shift</th>";
        echo "<th>Department</th>";
        echo "<th>Date</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($data = $result->fetch_assoc()){  
            echo "<tr>";
            echo "<td>".$data['empid']."</td>";
            echo "<td>".$data['empname']."</td>";
            echo "<td>".$data['shift']."</td>";
            echo "<td>".$department[$data['department']]."</td>";
            echo "<td>".$data['date']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    }
?>
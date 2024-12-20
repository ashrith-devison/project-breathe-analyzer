<?php
    require '../../../database.php';
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }   
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $request = file_get_contents("php://input");
        $request = json_decode($request,true);
        $department = intval($request['departmentId']);
        $shift = $request['shiftId'];
        $sql = "SELECT * FROM shift_assigned s, employees e, ba_test t WHERE  s.ShiftID = '$shift' AND 
        s.employee_id = e.employee_id AND e.Department_Id = $department AND t.Employee_ID = e.employee_id 
        AND (CURDATE() =DATE(s.randomized_time) OR CURDATE() = DATE(t.test_time))
        AND t.Test_ID = s.id";
        $result = $conn->query($sql);
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Employee ID</th>";
        echo "<th>Employee Name</th>";
        echo "<th>Status</th>";
        echo "<th>Randomized Time </th>";
        echo "<th>Results</th>";
        echo "<th>Master List</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($data = $result->fetch_assoc()){  
            echo "<tr>";
            echo "<td>".$data['Employee_ID']."</td>";
            echo "<td>".$data['Emp_Name']."</td>";
            echo "<td>".$data['Status']."</td>";
            echo "<td>".$data['randomized_time']."</td>";
            $data['randomized_time'] = date('Y-m-d',strtotime($data['randomized_time']));
            echo <<<HTML
                    <td>
                        <button style="color : blue; background-color : white;" onclick='viewResults("{$data['Employee_ID']}", "{$data['Test_ID']}")'>
                        <i class="fas fa-eye"></i>
                        </button>
                    </td>
                    <td>
                        <button style="color : blue; background-color : white;" onclick='view_master_list("{$data['Department_Id']}", "{$data['ShiftID']}", "{$data['randomized_time']}")'>
                        <i class="fas fa-edit"></i>
                        </button>
                    </td>
                    HTML;
            echo "</tr>";
        }
        echo "</tbody>";
    }
?>
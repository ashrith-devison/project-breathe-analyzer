<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        require '../../../database.php';
        function updateShiftAssigned($empid,$shift,$status){
            require '../../../database.php';
            $query = "INSERT INTO shift_assigned (Employee_ID,ShiftID) VALUES ($empid,'$shift')";
            $conn->query($query);
            $query = "INSERT INTO ba_test (Employee_ID,Status) VALUES ($empid,'$status')";
            $conn->query($query);
            $conn->close();
        }
        
        function updateenvdata($deptcode){
            require '../../../database.php';
            $query = "UPDATE envdata SET randomized_time = NOW() WHERE dept_code = '$deptcode';";
            $conn->query($query);
            $conn->close();
        }

        $request = file_get_contents("php://input");
        $request = json_decode($request);

        $empid = $request->empId;
        $empname = $request->empName;
        $shift = $request->shiftId;
        $deptcode = $request->deptCode;
        $pendinglist = intval($request->selected);
        $data = array_map(null,$empid,$empname);
        echo "<h4 style='text-align: center;font-size:40px;>Shortlisted People from Randomizer</h4>";
        echo "<h4 style='text-align: center;font-size:20px;'>"."Date: ".date('d-m-Y h:i:s a')."</h4>";
        echo "<h4 style='text-align: center;font-size:20px;'>"."Shift: ".$shift."</h4>";
        echo "<link rel='stylesheet' href='/admin/results/randomizer/table.css'>";
        echo "<table class='table' >";                                                                                                                                                                                                                                                                                  
        echo "<thead>";
        echo "<tr>";
        echo "<th>Employee Id</th>";
        echo "<th>Employee Name</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        echo "</thead><tbody>";

        if(!$conn){
            die("Connection Error");
        }
        $count = 0;
        foreach($data as $emp){
            if($count < $pendinglist){
                list($empid, $empname) = $emp;
                echo "<tr>";
                echo "<td>".$empid."</td>";
                echo "<td>".$empname."</td>";
                updateShiftAssigned(intval($empid),$shift,"pending");
                echo "<td>"."Selected"."</td>";
                echo "</tr>";
                $count++;
            }
            else{
                list($empid, $empname) = $emp;
                echo "<tr>";
                echo "<td>".$empid."</td>";
                echo "<td>".$empname."</td>";
                updateShiftAssigned(intval($empid),$shift,"Stand-by");
                echo "<td>"."Stand-By"."</td>";
                echo "</tr>";
            }
        }
        echo "</tbody>";
        updateenvdata($deptcode);
    }

    else{
        echo 
        "<script src='/node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
        <script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid Request',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        </script>";
    }

?>
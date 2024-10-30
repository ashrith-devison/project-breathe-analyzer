<?php
    function dept_list(){
        require __DIR__."../../../database.php";
        $sql = "SELECT * FROM Department";
        $depts = $conn->query($sql);
        echo "<option value='' selected>DEPARTMENT</option>";
        while($dept = $depts->fetch_assoc()){
            echo "<option value='".$dept['Department_Id']."'>".$dept['Department_name']."</option>";
        }
    }
?>
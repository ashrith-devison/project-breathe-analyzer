<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/bootstrap-3.4.1/css/bootstrap.min.css">
  <script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="/admin/home-page/home.css">
  <script src="/login/authentication.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<link rel="stylesheet" href="/font-awesome-icons/css/all.min.css">

  <title>AAI-Home</title>
</head>
<body oncontextmenu="return false;" id="body">
  <script src="/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <div id="script-record"></div>
  <div class="header" style="height: 20vh;background-color: aliceblue;">
  <p id="UserId" hidden><?php
    require "../admin/departments/dept-list.php";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $request = file_get_contents("php://input");
        $request = json_decode($request,true);
        if(!isset($request['userid'])){
            throw new Exception('User ID not set in the request');
        }
        echo $request['userid'];
    }
    else{
        echo '';
        $request['userid'] = '';
    }
?></p>
    <div class="header-left" style="width: 20vw;"><img src="/admin/home-page/images/AAI-Logo.png" alt="" class="image-fluid" style="width: 150px; height: 100px;"></div>
    <div class="header-center" style="width: 70vw;">
      <div><button id='home-home' class="btn btn-success" onclick="home_reset();" style="display: flex; align-items: center;"><svg style="margin-right: 8px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      HOME</button></div>
      <div style="height: 35px; background-color: #337ab7; color: white; display: flex; align-items: center;">
        <svg style="margin-right: 8px; margin-left: 7px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <select name="" id="department-selection" onchange="fetch_allocation_data();"
            style="height: 35px; background-color: #337ab7; color: white; flex-grow: 1;">
            <?php
              dept_list();
            ?>
        </select>
    </div>
      <div><button id='employee-home' type = "button" onclick="employee_home()" class="btn btn-primary" style="display: flex; align-items: center;"><svg style="margin-right: 8px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
    </svg>EMPLOYEE</button></div>
    <div style="height: 20px; width: 20px; padding: 2px; position: absolute; left: 91%; top: 2.3%;">
    <a href="/UserLogin.html">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="#337ab7" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" x2="9" y1="12" y2="12"/>
        </svg>
    </a>
    </div>
      <div><button id='result-home' onclick="fetch_result_data(); " type="button" class="btn btn-primary" style="display: flex; align-items: center;"><svg style="margin-right: 8px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-pen"><path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><path d="M18.4 2.6a2.17 2.17 0 0 1 3 3L16 11l-4 1 1-4Z"/>
    </svg>RESULTS</button></div>
    </div>
    <div class="header-right" style="position: relative; right: 4%;top: 18%;height: fit-content;" data-toggle="tooltip"
    id='user-profile'
    ><div id="aai-profile" style="height: 50px;width: 50px;background-color: black;border-radius: 100%;">
  </div>
  <button style="position: relative; right: 14%; margin-top: 4px; background-color: #70e000;" class="btn btn-info" type='button' id="user-profile-dropdown" onclick='settingsinit();'>
  Settings</button>
</div>
  </div>
  
    <div class="demo-down">
    <div class="home-content">
    <div class="container">  
        <div id="shift-form" class="form-group" hidden>
            <form action="">
              <select id="department-selection-result" class="form-control" required style="margin-top:6px">
               <?php
                dept_list();
               ?>
              </select>
                <select id="shift-selection" class="form-control" required onchange="randomized_data();" style="margin-top:4px">
                    <option value="">SHIFT</option>
                    <option value="S1" id="shift-1">Shift - 1</option>
                    <option value="S2" id="shift-2">Shift - 2</option>
                    <option value="S3" id="shift-3">Shift - 3</option>
                    <option value="GEN" id="general">General</option>
                </select>
            </form>
        </div>
    <div class="table-container" id="request-table" style="position:absolute;left:12vw;height:60%;display:none;padding:6px; border-radius:10px;">
      <div class="continue"><button class="btn btn-success" style="position: relative;left: 90%;">Print</button></div>
    </div>
  </div>
  <div id='spotlight'>
  </div>
  </div>
  <div class="container  extra-info" id="add-info">
  </div>
    </div>
  <script src="/bootstrap-3.4.1/js/bootstrap.min.js"></script>
  <script src="/admin/home-page/home.js"></script>
</body>
</html>
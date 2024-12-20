<style>
  input,select {
  width: 95%;
  padding: 8.3px;
  box-sizing: border-box;
}
</style>
<form action="" style="position: relative; top: 25%; z-index: 2" onsubmit="return false;" class="form">
      <div class="close-button-div">
        <span class="close-button" onclick="closeForm()">✖</span>
      </div>
    <h3 style="text-align: center; font-weight: bolder">Employee Profile</h3>
    <div id = 'entry-status'>
      <h4 style="text-align: center;"><strong class="blink"><em>Status: Active</em></strong></h4>
    </div>
      <fieldset>
        <label name="emp-id">Employee ID</label>
        <input type="number" id ='emp-id' name="emp-id" placeholder="ID" disabled>
      </fieldset>
      <fieldset>
      <label name="emp-name">Employee Name</label>
      <input type="text" id = 'emp-name' name="emp-name" placeholder="Name" >
      </fieldset>
      <fieldset>
        <label name="department">Department</label>
        <br>
        <select id="dept-id" name="department">
          <?php
            require_once '../../departments/dept-list.php';
            dept_list();
          ?>
        </select>
      </fieldset>
      <fieldset>
        <label name="emp-role">Designation</label>
        <input type="text" id='emp-role' name="emp-role" placeholder="Designation">
      </fieldset>
      <fieldset>
        <label name="emp-email">Designation</label>
        <input type="email" id='emp-email' name="emp-email" placeholder="example@aac.in">
      </fieldset>
      <button onclick="updateEmployeeDetails();" id="entry-form-submit" class="btn btn-success">Update</button>
      <br><br>
</form>
<style>
  @keyframes blink {
      0% {color: red;}
      25% {color: blue;}
      50% {color: green;}
      75% {color: yellow;}
      100% {color: red;}
  }
  .blink {
      animation: blink 1s linear infinite;
  }
  .close-button-div {
      position: absolute;
      top: 5px;
      right: 5px;
  }
  .close-button {
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
  }
</style>

</style>

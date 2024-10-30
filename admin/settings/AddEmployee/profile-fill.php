
<form onsubmit="addEmployeeDB();return false;" autocomplete="off">
    <div class="form-group">
        <label for=""><h4>Employee ID : </h4></label>
        <input type="number" id="employee-id-add">
    </div>
    <div class="form-group">
        <label for="input2"><h4>Employee Name : </h4></label>
        <input type="text" id="employee-name-add">
    </div>
    <div class="form-group">
        <label for="select1"><h4>Department :</h4></label>
        <select id="department-id-add">
            <?php
                require_once '../../departments/dept-list.php';
                dept_list();
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="input1"><h4>Designation : </h4></label>
        <input type="text" id="designation-add">
    </div>
    <div class="form-group">
        <label for="email-add"><h4>Email : </h4></label>
        <input type="email" id="email-add">
    </div>
    <button type="submit">Add to List</button>
</form>

<style>
form {
background-color: #e6e5e5; /* Light gray background */
padding: 2rem; /* Padding around the form */
border-radius: 4px; /* Rounded corners */
max-width: 600px; /* Maximum width */
margin: 0 auto; /* Center the form */
border: solid rgb(113, 109, 109);
}

.form-group {
margin-bottom: 1rem;
display: flex;
justify-content: space-between; /* Space out the label and field */
align-items: center; /* Vertically align the label and field */
}

.form-group label {
flex: 1; /* Take up 1 part of the space */
margin-right: 1rem; /* Space between the label and field */
font-weight: bold;
}

.form-group select, .form-group input {
flex: 2; /* Take up 2 parts of the space */
width: 40%;
padding: 0.75rem;
border: none;
border-radius: 4px;
background-color: #f3f3f3;
color: #333;
font-size: 15px;
transition: background-color 0.3s ease;
}

.form-group select:focus, .form-group input:focus {
outline: none;
border:1px solid black;
}

button[type="submit"] {
display: block;
width: 30%;
padding: 1rem;
border: none;
border-radius: 4px;
background-color: #0078d4;
color: #fff;
font-size: 15px;
cursor: pointer;
transition: background-color 0.3s ease;
margin: 0 auto; /* Center the button */
}

button[type="submit"]:hover {
background-color: #005999;
}
</style>
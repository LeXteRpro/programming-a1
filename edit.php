<?php

    //Connect
    require_once "config.php";

    $assignmentID = "";
    $name         = "";
    $courseCode   = "";
    $teacher      = "";
    $dueDate      = "";
    $complete     = false;
    $userMessage  = "";
    $courseCodes = array();

    // If submit is true, it is set
    if (isset($_POST['submit'])) {

        $isValid = true;


    //Grab data from the form
        $assignmentID = $_POST['assignmentID'];
        $name         = $_POST['name'];
        $courseCode   = $_POST['courseCode'];
        $teacher      = $_POST['teacher'];
        $dueDate      = $_POST['dueDate'];

    // If complete is selected, complete is true
        if (isset($_POST['complete'])) {
            $complete = 1;
        }
    // Else if it is not selected, set to false
        else {
            $complete = 0;
        }
    //If name is not entered, echo that the assignment is required.
        if ($name == "") {
            $isValid = false;
            $userMessage = "Assignment name is required";
        }
    // If user input is valid, run the query
        if($isValid) {
            $sql =
                "UPDATE assignment
                SET
                    assignment.name        = '$name',
                    assignment.course_code = '$courseCode',
                    assignment.teacher     = '$teacher',
                    assignment.due_date    = '$dueDate',
                    assignment.complete    = '$complete'
                WHERE
                    assignment_id = $assignmentID";
            $conn->query($sql);

            header('Location: projects.php');
            die();
        }
    }
    else {

        $assignmentID = $_GET['assignment_id'];
        //Getting the information from the database
        $sql =
            "SELECT
                assignment.assignment_id,
                assignment.name,
                assignment.course_code,
                assignment.teacher,
                assignment.due_date,
                assignment.complete
            FROM
                assignment
            WHERE
                assignment_id = $assignmentID";

        //Querying the database, get the data from the database, retrieve the data
        $result = $conn->query($sql);

        foreach ($result as $row) {
            $assignmentID = $row['assignment_id'];
            $name         = $row['name'];
            $courseCode   = $row['course_code'];
            $teacher      = $row['teacher'];
            $dueDate      = $row['due_date'];
            $complete     = $row['complete'];

            if ($complete == 1) {
                $complete = true;
            }
            else {
                $complete = false;
            }
        }
    }

//Grab course ID from the database
    $sql =
        "SELECT
            courses.course_id,
            courses.code
        FROM
            courses";

    //Querying the database, get the data from the database, retrieve the data
    $result = $conn->query($sql);

    foreach ($result as $row) {
        $courseID = $row['course_id'];
        $code = $row['code'];

        $courseCodes[$courseID] = $code;
    }
?>


<!--Create the edit page form-->
<!DOCTYPE html>
<html>
<head>
    <title>View</title>
</head>
<body>
    <?php echo $userMessage; ?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input name="assignmentID" type="hidden" value="<?php echo $assignmentID; ?>">
        <div>
            <label for="name">Assignment</label>
            <input name="name" type="text" required value="<?php echo $name; ?>" />
        </div>
        <div>
            <label for="courseCode">Course Code:</label>
            <select name="courseCode">
            <!-- Print an option out for each course code-->
                <?php foreach ($courseCodes as $courseID => $code) { ?>

                    <option value="<?php echo $courseID; ?>" <?php if($courseID == $courseCode){echo "selected";}?>><?php echo $code; ?></option>

                <?php } ?>
            </select>
        </div>
        <div>
            <label for="teacher">Teacher:</label>
            <input name="teacher" type="text" value="<?php echo $teacher; ?>" />
        </div>
        <div>
            <label for="dueDate">Due Date:</label>
            <input name="dueDate" type="datetime" value="<?php echo $dueDate; ?>" />
        </div>
        <div>
            <label for="complete">Complete:</label>
            <input name="complete" type="checkbox" <?php if ($complete) {echo "checked";} ?> />
        </div>


        <input type="submit" name="submit" value="Save" />
    </form>

</body>
</html>
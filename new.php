<?php

    // Connect
    require_once "config.php";


    // Assign the variables
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
//If the user hasn't handed you garbage, run the query.
        if($isValid) {
            $sql =
                "INSERT INTO assignment
                    (`name`, course_code, teacher,  due_date, complete) VALUES
                    ('$name',  '$courseCode', '$teacher', '$dueDate', '$complete')";
            $conn->query($sql);

//Redirect to projects.php
           header('Location: projects.php');
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
<!-- Create the "new" page form-->
<!DOCTYPE html>
<html>
<head>
    <title>New</title>
</head>
<body>
    <?php echo $userMessage; ?>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div>
            <label for="name">Assignment</label>
            <input name="name" type="text" required value="<?php echo $name; ?>" />
        </div>
        <div>
            <label for="courseCode">Course Code:</label>
            <select name="courseCode">
            <!-- Print an option out for each course code-->
                <?php foreach ($courseCodes as $courseID => $code) { ?>

                    <option value="<?php echo $courseID; ?>" ><?php echo $code; ?></option>

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
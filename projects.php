<?php


//1. connect to database
$conn = new PDO('mysql:host=localhost;dbname=php', 'root', '');

$assignment = "";
$coursecode = "";
$teacher = "";
$duedate = "";
$complete = "";


    if (isset($_POST['submit']) ) {

        $assignment = $_POST['assignment'];
        $coursecode = $_POST['course-code'];
        $teacher = $_POST['teacher'];
        $duedate = $_POST['due-date'];
        $complete = $_POST['complete'];
      }

        //user clicked "submit"
         if (isset($_GET['assignment_id'])) {

            //Update subscribers
            $assignment_id = $_GET['assignment_id'];
            $sql =
                "UPDATE assignments
                SET
                    assignment = '$assignment',
                    course-code = '$coursecode',
                    teacher = '$teacher',
                    duedate = '$duedate',
                    complete ='$complete'
                WHERE
                    assignment_id = $assignment_id";
            $conn->query($sql);

            header('Location: project-display.php');
         }
         else {
            //Create new subscriber
            $sql =
                "INSERT INTO assignments
                (first_name,    last_name,    email   ) VALUES
                ('$first_name', '$last_name', '$email')";
            $conn->query($sql);

            header('Location: project-display.php');
         }


//2. set up the query to get list of assignments
$sql = "SELECT assignments FROM .php";

//3. exeute the query & store the results
$result = $conn->query($sql);

//4. loop through the results
foreach ($result as $row) {
//5. output each country in <option> </option> tags
    echo '<option>' .$row['assignment']. '</option>';

}

      foreach ($result as $row) {
          $assignment = $_POST['assignment'];
          $coursecode = $_POST['course-code'];
          $teacher = $_POST['teacher'];
          $duedate = $_POST['due-date'];
          $complete = $_POST['complete'];
        }

        $action .= "?assignment_id=$assignment_id";

        //disconnect
        $conn = null;

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Assignments</title>
    </head>
    <body>
        <form method="post" action="<?php echo $action; ?>">
            <div>
                <label for="assignment">Assignment</label>
                <input name="assignment" required value="<?php echo $assignment; ?>" />
            </div>
            <div>
                <label for="course-code">Course Code:</label>
                <input name="course-code" required value="<?php echo $coursecode; ?>" />
            </div>
            <div>
                <label for="teacher">Teacher:</label>
                <input name="teacher" required value="<?php echo $teacher; ?>" />
            </div>
            <div>
                <label for="due-date">Due Date:</label>
                <input name="due-date" required value="<?php echo $duedate; ?>">
            </div>
            <div>
                <label for="complete">Complete:</label>
                <input name="complete" required value="<?php echo $complete; ?>">
            </div>


            <input type="submit" name="submit" value="Subscribe" />
        </form>
    </body>
</html>
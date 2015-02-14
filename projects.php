<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>Subscriber List</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>
        <a href="new.php">Add a new assignment</a>
        <?php
            //Connect
            require_once "config.php";

            // Grabbing the information from the database
            $sql =
                "SELECT
                    assignment.assignment_id,
                    assignment.name,
                    courses.code,
                    assignment.teacher,
                    assignment.due_date,
                    assignment.complete
                FROM
                    assignment
                    JOIN courses ON assignment.course_code = courses.course_id";

            //Connect to the query
            $result = $conn->query($sql);

            //HTML Table
            ?>
                <table>
                    <tr>
                        <th>Assignment</th>
                        <th>Course Code</th>
                        <th>Teacher</th>
                        <th>Due Date</th>
                        <th>Complete</th>
                    </tr>
                    <!-- Loop through the rows in the database -->
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['code']; ?></td>
                            <td><?php echo $row['teacher']; ?></td>
                            <td><?php echo $row['due_date']; ?></td>
                            <td>
                            <!-- Enter back into php mode for loop-->
                                <?php
                                //If assignment is incomplete, display "No" for not complete.
                                    if ($row['complete'] == 0) {
                                        echo "No";
                                    }
                                //If assignment is complete, display "Yes" for not complete.
                                    else {
                                        echo "Yes";
                                    }
                                ?>
                            </td>

                            <td>
                            <!-- Link to the assignment_id page for the current assignment-->
                                <a href="edit.php?assignment_id=<?php echo $row['assignment_id']; ?>">Inspect</a>
                            </td>
                            <td>
                            <!--Go to Delete page for the current assignment_id-->
                                <a href="delete.php?assignment_id=<?php echo $row['assignment_id']?>"
                                    onclick="return confirm(\'Are you sure you want to delete this subscriber?\');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php

            //Disconnect
            $conn = null;
        ?>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>Subscriber List</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>
        <a href="projects.php">Add a new assignment</a>
        <?php
            //1. connect
            $conn = new PDO('mysql:host=localhost;dbname=php', 'root', '');

            //2. write sql query
            $sql =
                "SELECT
                    assignment.assignment_id,
                    assignment.name,
                    assignment.course_code,
                    assignment.teacher,
                    assignment.due_date,
                    assignment.complete
                FROM
                    assignment";

            //3. execute the query and store the results
            $result = $conn->query($sql);

            //4. start our html table / grid
            ?>
                <table>
                    <tr>
                        <th>Assignment</th>
                        <th>Course Code</th>
                        <th>Teacher</th>
                        <th>Due Date</th>
                        <th>Complete</th>
                    </tr>

                    <?php
                        //5. Loop through the date and print the rows and columns.
                        foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['course_code']; ?></td>
                                    <td><?php echo $row['teacher']; ?></td>
                                    <td><?php echo $row['due_date']; ?></td>
                                    <td><?php echo $row['complete']; ?></td>

                                    <td>
                                        <a href="projects.php?assignment_id=<?php echo $row['assignment_id']; ?>">Inspect</a>
                                    </td>
                                    <td>
                                        <a href="delete-subscriber.php?subscriber_id=<?php echo $row['subscriber_id']?>"
                                            onclick="return confirm(\'Are you sure you want to delete this subscriber?\');">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>
            <?php

            //6. Close the table

            //7. Disconnect
            $conn = null;
        ?>
    </body>
</html>
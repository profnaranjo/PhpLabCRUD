<?php
# list all users
try {

    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

require "templates/header.php";


if ($result && $statement->rowCount() > 0) {
    ?>
    <h2>Results: <?php echo $statement->rowCount() . " user(s) found"; ?></h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {
                ?>
                <tr>
                    <td><?php echo escape($row["id"]); ?></td>
                    <td><?php echo escape($row["firstname"]); ?></td>
                    <td><?php echo escape($row["lastname"]); ?></td>
                    <td><?php echo escape($row["email"]); ?></td>
                    <td><?php echo escape($row["age"]); ?></td>
                    <td><?php echo escape($row["location"]); ?></td>
                    <td><?php echo escape($row["date"]); ?> </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
    <?php
}
?>
<br><br>
<a href="index.php">Main Page</a>

<?php require "templates/footer.php";    
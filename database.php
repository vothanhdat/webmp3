<table>


    <?php

    include 'sqlconfig.php';
    $conn = mysqli_connect($sql_servername, $sql_username, $sql_password, $sql_dbname);
    mysqli_set_charset($conn, "utf8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

    <?php
    if (isset($_GET['product'])) {

        $choose = $_GET["Choose"];
        switch ($choose) {
            case 1:
                //execute the SQL query and return records
                $result = $conn->query("SELECT * FROM product");
                //fetch the data from the database
                ?>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>CATALOG</th>
                        <th>MANUFACTOR</th>
                        <th>Price</th>
                        <th>Quatity</th>
						<th>Preview</th>
						<th>Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row{'id'} .
                            "</td><td>" . $row{'name'} .
                            "</td><td>" . $row{'catalogID'} .
                            "</td><td>" . $row{'manufactorID'} .
                            "</td><td>" . $row{'price'} .
                            "</td><td>" . $row{'quatity'} . 
							 "</td><td>" . $row{'preview'} .
							 "</td><td>" . $row{'detail'} ."</td>";
                        echo "</tr>";
                    } ?>
                    </tbody>
                </table>

                <?php

                break;

            case 2:
                //INSERT INTO TABLE

                $manufactureID = $_GET["manufactorID"];
                $catalogID = $_GET["CatalogID"];
                $id = $_GET["Id"];
                $name = $_GET["Name"];
                $preview = $_GET["preview"];
                $price = $_GET["Price"];
                $quatity = $_GET["quatity"];
				$detail = $_GET["detail"];

                $sql = "INSERT INTO product (id,catalogID,manufactorID,name, preview, price, quatity,detail) VALUES ('$id', '$catalogID', '$manufactureID','$name', '$preview', '$price', '$quatity','$detail')";
                if ($conn->query($sql) === true) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                break;
            case 3:
                $manufactorID = $_GET["manufactorID"];
                $catalogID = $_GET["CatalogID"];
                $id = $_GET["Id"];
                $name = $_GET["Name"];
                $preview = $_GET["preview"];
                $price = $_GET["Price"];
                $quatity = $_GET["quatity"];
                //UPDATE
                $sql = "update product Set id='$id', name = '$name', catalogID= '$catalogID', manufactorID= '$manufactorID', preview= '$preview', price = '$price', quatity='$quatity' WHERE id= '$id'";
                if ($conn->query($sql) === true) {
                    echo "Update successfully";
                } else {
                    echo "Error Update";
                }
                break;
            case 4:
                $id = $_GET["Id"];
                //DELETE RECORD
                $sql = "DELETE FROM product WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record " . $conn->error;
                }
                break;
			case 5:
                $id = $_GET["Id"];
				$detail = $_GET["detail"];
                //DELETE RECORD
                $sql = "update product Set detail= '$detail' WHERE id= '$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "Update successfully";
                } else {
                    echo "Error Update";
                }
            break;
        }
    } else if (isset($_GET['manufactor']) || isset($_GET['catalog'])) {

        $tablename = isset($_GET['manufactor']) ? "manufacture" : "catalog";
        $choose = $_GET["Choose"];
        switch ($choose) {
            case 1:
                ?>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>IMAGE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM $tablename");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row{'id'} .
                            "</td><td>" . $row{'name'};
                    } ?>
                    </tbody>
                </table>

                <?php

                break;

            case 2:
                //INSERT INTO TABLE

                $id = $_GET["id"];
                $name = $_GET["name"];
                $img = $_GET["img"];

                $sql = "INSERT INTO $tablename (id,name,img) VALUES ('$id', '$name','$img')";
                if ($conn->query($sql) === true) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                break;
            case 3:
                $id = $_GET["id"];
                $name = $_GET["name"];
                $img = $_GET["img"];

                //UPDATE
                $sql = "update $tablename Set name = '$name', img= '$img' WHERE id= '$id'";
                if ($conn->query($sql) === true) {
                    echo "Update successfully";
                } else {
                    echo "Error Update";
                }
                break;
            case 4:
                $id = $_GET["id"];
                //DELETE RECORD
                $sql = "DELETE FROM $tablename WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record " . $conn->error;
                }
                break;
        }


    }


    ?>

    <?php
    //close the connection
    $conn->close();
    ?>
</table>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>NBA Player Database</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./styles.css">
    </head>

    <body>
        <div class="container text-center">
            <br>
            <h1>Update Values For Coaches:</h1>
            <br><br>
            <div class="container text-start">
                <form method="POST" action="./coach_update.php">
                    <div class="form-group row">
                        <label for="cID" class="col-sm-2 col-form-label">Coach ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cID" name="cID" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="full_name" class="col-sm-2 col-form-label">New Coach Name (optional):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="full_name" name="full_name">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="tID" class="col-sm-2 col-form-label">New Team ID (optional):</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="tID" name="tID">
                        </div>
                    </div>
                    <br><br>
                    <input type="submit" value="Update" name="updateSubmit">
                </form>
                <br>
                <form method="POST" action="./coach_update.php">
                    <input type="submit" value="View All Coaches" name="viewCoaches">
                </form>
            </div>
        </div>
        <br><br>
        <?php include('coach_update_result.php');?>
        <script src="index.js"></script>
    </body>
</html>
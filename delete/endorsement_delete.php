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
            <h1>Delete Endorsements:</h1>
            <br><br>
            <div class="container text-start">
                <form method="POST" action="./endorsement_delete.php">
                    <div class="form-group row">
                        <label for="eID" class="col-sm-2 col-form-label">Endorsement ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="eID" name="eID" required>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Delete by Endorsement ID" name="deleteByEndorsementIDSubmit">
                </form>
                <br><br>
                <form method="POST" action="./endorsement_delete.php">
                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label">Brand:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="Delete by Brand" name="deleteByBrandSubmit">
                </form>
                <br><br>
                <form method="POST" action="./endorsement_delete.php">
                    <input type="submit" value="View All Endorsements" name="viewEndorsements">
                </form>
                <br>
                <form method="POST" action="./endorsement_delete.php">
                    <input type="submit" value="View All Sponsors" name="viewSponsors">
                </form>
            </div>
        </div>
        <br><br>
        <?php include('endorsement_delete_result.php');?>
        <script src="index.js"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css"/>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.js"></script>
    <script src="bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitter&family=Bricolage+Grotesque:opsz@10..48&family=IBM+Plex+Sans:wght@300&family=Overpass:wght@500&family=Quicksand:wght@300&family=Roboto+Slab&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <title>Admin Page</title>
</head>
<body>
    <form action="add.php" method="post" class="form">
        <h1>Admin Page</h1>
        <fieldset style='display:flex;justify-content:center;flex-direction:column;align-items:center;padding:20px 40px 20px 40px;background-color: rgba(255, 255, 255, 0.5);'>
        <div class="mb">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text">User-Id</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Roll No" name="user_id" required>
          </div>
          <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label text">Description</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Description" name="Description" required>
          </div>
          <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label text">Fees Amount</label>
            <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Fees" name="Fees" required>
          </div>
        </div>
        <button class="btn btn-success text" id="add-row-btn">Update</button>
</fieldset>
      </form>
    <form action="delete.php" class="form" method="post">
    <fieldset style='display:flex;justify-content:center;flex-direction:column;align-items:center;padding:20px 40px 20px 40px; background-color: rgba(255, 255, 255, 0.5);'>
    <div class="mb">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text">User-Id</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Roll No" name="user_id" required>
          </div>
    </div>
      <button class="btn btn-danger">Delete</button>
    </fieldset>
    </form>
    <center class='due'>
      <a href="due form.html" class='btn btn-warning'>Due Date</a>
      <a href="fine form.html" class='btn btn-primary'>Fine addition</a>
    </center>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <?php
        if($_POST['keyword'] && strlen(trim($_POST['keyword']))>0 ){
            $keyword = $_POST['keyword'];
            include 'base.php';
            $transaction = new Transaction();
            $transaction->doTrans("hanap",$keyword );
        }else{
            echo "Empty!";
        }
    ?>
    <form action="search.php" method="post">
        <input type="text" name="keyword" required>
        <input type="submit" value="Search">
    </form>
</body>
</html>
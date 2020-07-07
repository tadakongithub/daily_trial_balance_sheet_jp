<?php
    session_start();

    require 'db.php';

    if($_POST['login']) {
        if(empty($_POST['branch_name']) || empty($_POST['password'])) {
            $message = 'All fields are required';
        }  else {
            $query = 'SELECT * FROM branch_list WHERE name = :name';
            $statement = $myPDO->prepare($query);
            $statement->execute(array(
                'name' => $_POST['branch_name']
            ));
            $branch = $statement->fetch();
            if($branch && password_verify($_POST['password'], $branch['password'])) {
                $_SESSION['branch'] = $_POST['branch_name'];
                $_SESSION['logged_in'] = 'logged_in';
                header('Location: index.php');
            } else {
                $message = '店舗名とパスワードが一致しませんでした。';
            }
        }
    }

?>

<html>
<head>
    <?php require 'head.php'; ?>
</head>
<body  class="flex-body">
<div  class="home-container">
<?php
    if(isset($message)) {
        echo '<p>' . $message . '</p>';
    }
?>
    <h1 class="ui header">LMJ</h1>
        <form action="" method="post" class="ui form">
            <div class="field">
                <label for="branch_name">店舗名</label>
                <select name="branch_name" id="branch_name" class="ui dropdown" required>
                <?php foreach($myPDO->query('SELECT * FROM branch_list') as $row):?>
                    <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                <?php endforeach ;?>
                </select>
            </div>
            <div class="field">
            <label for="password">パスワード</label>
                <input type="text" name="password" id="password" required>
            </div>
            <input type="hidden" name="login" value="login">

            <button type="submit" class="ui button">ログイン</button>
           
        </form>
</div>

<script src="semantic-ui-pulldown.js"></script>
</body>
</html>



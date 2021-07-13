  <?php 
     session_start();
     session_regenerate_id(true);
     if(isset($_SESSION['member_login'])==false)
     {
        print 'ようこそゲスト様';
        print '<a href = "member_login.html">会員ログイン</a><br>';
        print '<br>';  
         
     } 
     else {
        print 'ようこそ';
        print $_SESSION['member_name'];
        print '様<br>';
        print '<a href = "member_logout.php">ログアウト</a><br>';  
        print '<br>';
     }

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園</title>
</head>
<body>
    <?php

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';

        try
        {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT code, name, price FROM mst_product WHERE 1';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;

            print '商品一覧<br><br>';

            // print '<form method="post" action="pro_branch.php">';
            while(true)
            {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                if($rec==false)
                {
                    break;
                }

                print '<a href="shop_product.php?procode='.$rec['code'].'">';
                print $rec['name'].'---';
                print $rec['price'].'円';
                print '</a>';
                print '<br>';

            }
            print '<br>';
            print '<a href="shop_cartlook.php">カートを見る</a><br>';
        }
        catch (Exception $e)
        {
            print 'ただいま障害により大変ご迷惑をおかけしております。';
            exit();
        }
    ?>

</body>

</html>
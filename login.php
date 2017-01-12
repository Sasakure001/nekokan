<?php
$ERR_STR = "";

session_start();
if(isset($_SESSION['nekokann']['err']) && $_SESSION['nekokann']['err'] != ""){
    $ERR_STR = $_SESSION['nekokann']['err'];
}

session_unset();
session_destroy();

if(isset($_POST['neko_name']) && isset($_POST['neko_pass'])){
    if(chk_neko_name(
        strip_tags($_POST['neko_name']),
        strip_tags($_POST['neko_pass']))){
        session_start();
    $_SESSION['nekokann']['neko_name'] = strip_tags($_POST['neko_name']);
    header("Location: index.php");
}
}

function chk_neko_name($neko_name,$neko_pass){
    global $ERR_STR;

    if($neko_name != "nekokann"){
        $ERR_STR .= "「ろぐいんID」がちがいます。\n";
        return false;
    }
    //暗号化によるパスワード認証
    if($neko_pass != "wiz2016"){
        $ERR_STR .= "「ぱすわーど」がちがいます。\n";
        return false;
    }
    return true;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>ねこかん</title>
    <link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- コンテナ開始 -->
    <div id="container">
        <!-- ページ開始 -->
        <div id="page">
            <!-- ヘッダ開始 -->
            <div id="header">
                <h1 class="siteTitle"><a><img src="img/logo3.png" alt="タイトル"  height="15%"></a>
                </h1>
            </div>
            <!-- ヘッダ終了 -->
            <!-- コンテンツ開始 -->
            <!-- ログイン -->
            <div class="center">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <CENTER>
                        <table id="id">

                            <tr>
                                <th>
                                    <a><img src="img/id.png" alt="ID"  height="130px"></a>
                                </th>
                                <td>
                                    <input type="text" size="20" name="neko_name" value="" style=" width:400px; height: 50px; font-size: 35px; ime-mode: disabled;" />
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <a><img src="img/pass.png" alt="PASS" height="85px"></a>
                                </th>
                                <td>
                                    <input type="password" size="20" maxlength="10" name="neko_pass" value="" style=" width:400px; height: 50px; font-size: 35px; ime-mode: disabled;"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <input type="submit" value="ろぐいん" name="login" id="image-btn">

                            <p id="red"><?php echo $ERR_STR; ?></p>



                </CENTER>
            </from>

            <!-- コンテナ終了 -->
            <!-- フッタ開始 -->
            <div id="footer">

                <footer>

                </footer>
            </div>
            <!-- フッタ終了 -->
        </div>
        <!-- ページ終了 -->
    </div>
    <!-- コンテナ終了 -->
</body>
</html>
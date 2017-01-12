<?php
require_once("session.php");
$nekokan_move_url = 0;

if(isset($_GET['aid'])
    && $_GET['aid'] !=""){
    $nekokan_move_url = $_GET['aid'];
}

function echo_nekokan_move(){
    global $nekokan_move_url;
    $retstr = '';

        $retstr =<<<END_BLOCK

                <embed id="video" src="../motion/{$nekokan_move_url}.swf" loop="true" autoStart="true" hidden="false" align="center" width="675" height="513">
                </embed>

END_BLOCK;

    echo $retstr;
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
                <div align="right">
<!--                     <a href="index.php"><img src="img/btop_btn.png" alt="トップにもどる"  height="7%"></a>
 -->
                    <a href="video_list.php"><img src="img/movie_btn.png" alt="タイトル"  height="8%"></a>
                    <a href="login.php"><img src="img/logout_btn.png" alt="タイトル" height="8%"></a>

                </div>
            </div>
            <!-- ヘッダ終了 -->
            <!-- コンテンツ開始 -->

            <CENTER>
            <?php echo_nekokan_move(); ?>
            </CENTER>

            <!-- コンテナ終了 -->

            <!-- フッタ開始 -->
            <footer>
                <CENTER>
                    <a href="index.php"><img src="img/btop_btn.png" alt="トップにもどる"  height="7%"></a>
                </CENTER>
            </footer>

            <!-- フッタ終了 -->
        </div>
        <!-- ページ終了 -->
    </div>
    <!-- コンテナ終了 -->
</body>
</html>
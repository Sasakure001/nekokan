<?php

require_once("session.php");

try{
//1ページのリミット
$limit = 50;
$row = array();
$page = 1;
$nekokan_moves = array();
//print_r($nekokan_moves);
//print_r($row);
$pdo = new PDO('mysql:host=localhost;dbname=nekokan;charset=utf8','root','root2016',
    array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$stmt = $pdo -> prepare("SELECT * FROM nekokan_move ORDER BY nekokan_move_id DESC");
$stmt->execute();

while ($row = $stmt->fetchObject())
{
    $nekokan_moves[] = array(
        'nekokan_move_id'=> $row->nekokan_move_id
        ,'nekokan_move_name' => $row->nekokan_move_name
        ,'nekokan_move_url' => $row->nekokan_move_url
        ,'nekokan_move_flg' => $row->nekokan_move_flg
        );
}

//print_r($stmt);


if(is_func_active()){
    // print_r($_POST['param']);
    switch($_POST['func']){
        case "del":
                //print_r($_POST['param']);
                // deljob();

        $sql = "DELETE FROM nekokan_move WHERE nekokan_move_id = :nekokan_move_id";
        $stmt = $pdo -> prepare($sql);
        $params = array(':nekokan_move_id'=>$_POST['param']);
        $stmt -> bindParam(':nekokan_move_id', $_POST['param'], PDO::PARAM_INT);
        $stmt -> execute($params);

        header("Location: video_list.php");

        break;
    }
}
else{
    //何もしない
}

function is_func_active(){
    if(isset($_POST['func']) && $_POST['func'] != ""){
        return true;
    }
    return false;
}

function echo_nekokan_move_list(){
    global $page;
    global $nekokan_moves;
    // print_r($nekokan_moves);

    $retstr = '';
    $urlparam = '&page=' . $page;
    $rowcount = 1;

    if(count($nekokan_moves) > 0){

        foreach($nekokan_moves as $key => $value){
            $javamsg =  '【' . $nekokan_moves[$key]['nekokan_move_name'] . '】';
            $nobottom = '';
            if($rowcount == count($nekokan_moves)){
                $nobottom = ' nobottom';
            }

            $delstr = '';
            if(count($nekokan_moves) > 0){
            $delstr =<<<END_BLOCK
<input type="image" src="img/sakujo.png" height="55px" onClick="javascript:del_func_form({$nekokan_moves[$key]['nekokan_move_id']},'{$javamsg}')" />
END_BLOCK;
}
            $str =<<<END_BLOCK
<tr>
<td width="65%" class="center{$nobottom}">
<a href="video_detail.php?aid={$nekokan_moves[$key]['nekokan_move_name']}">{$nekokan_moves[$key]['nekokan_move_name']}</a>
</td>
<td width="15%" class="center{$nobottom}">
{$delstr}
</td>
</tr>
END_BLOCK;
            $retstr .= $str;
            $rowcount++;

        }
    }
    else{
        $retstr =<<<END_BLOCK

<tr><td colspan="3" class="nobottom">「どうが」がみつかりません</td></tr>
END_BLOCK;
    }
    echo $retstr;
}

function echo_tgt_uri(){
    global $page;
    echo $_SERVER['PHP_SELF']
        . '?page=' . $page;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="css/main_index.css" rel="stylesheet" type="text/css">
    <title>ねこかん</title>


<script type="text/javascript">

function set_func_form(fn,pm){
    document.form1.target = "_self";
    document.form1.func.value = fn;
    document.form1.param.value = pm;
    document.form1.submit();
}

function del_func_form(pm,mess){
    var message = "本当に\r\n";
    message += mess;
    message += "\r\nを削除しますか？";
    if(confirm(message)){
        document.form1.target = "_self";
        document.form1.func.value = 'del';
        document.form1.param.value = pm;
        document.form1.submit();
    }
}

</script>


</head>
<body>
    <!-- コンテナ開始 -->
    <div id="container">
        <!-- ページ開始 -->
        <div id="page">
            <!-- ヘッダ開始 -->
            <div id="header">
                <h1 class="siteTitle"><a><img src="img/logo3.png" alt="ロゴ" height="15%"></a>
                </h1>
                <div align="right" size="25">
                    <a href="index.php"><img src="img/ttop_btn.png" alt="トップ"  height="8%"></a>
                    <a href="login.php"><img src="img/logout_btn.png" alt="ログアウト"  height="8%"></a>
                </div>
            </div>
            <!-- ヘッダ終了 -->
            <!-- コンテンツ開始 -->
            <div id="content">
            <form name="form1" action="<?php echo_tgt_uri(); ?>" method="post" >
            <CENTER>
                <table>
                    <tr>
                        <th>ろくがにちじ</th>
                        <th>そうさ</th>
                    </tr>
                    <?php echo_nekokan_move_list(); ?>
                        </table>
                        </CENTER>
                            <input type="hidden" name="func" value="" />
                            <input type="hidden" name="param" value="" />
                        </form>
                    </div>
                    <!-- コンテナ終了 -->
                    <!-- フッタ開始 -->
                    <div id="footer">

                        <footer>
                            <CENTER>
                                <a href="index.php"><img src="img/btop_btn.png" alt="トップにもどる"  height="7%"></a>
                            </CENTER>
                        </footer>
                    </div>
                    <!-- フッタ終了 -->
                </div>
                <!-- ページ終了 -->
            </div>
            <!-- コンテナ終了 -->

            </html>
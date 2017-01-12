<?php
require_once("session.php");


$page = 1;

try{
    $pdo = new PDO('mysql:host=localhost;dbname=nekokan;charset=utf8','root','root2016',
        array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
   exit('データベース接続失敗。'.$e->getMessage());
}


if(isset($_POST['hide_val'])) {
      // echo $_POST['hide_val'];
    switch($_POST['hide_val']){
        case "01":
        $btn1_url ='sound/test1.wav';

        $stmt = $pdo -> prepare("INSERT INTO nekokan_sound (nekokan_sound_id, nekokan_sound_url, nekokan_sound_flg) VALUES (default, :nekokan_sound_url, :nekokan_sound_flg)");
        $stmt->bindParam(':nekokan_sound_url', $btn1_url, PDO::PARAM_STR);
        $stmt->bindValue(':nekokan_sound_flg', 0, PDO::PARAM_INT);
        $stmt->execute();

        break;

        case "02":
        $btn1_url ='sound/test2.wav';

        $stmt = $pdo -> prepare("INSERT INTO nekokan_sound (nekokan_sound_id, nekokan_sound_url, nekokan_sound_flg) VALUES (default, :nekokan_sound_url, :nekokan_sound_flg)");
        $stmt->bindParam(':nekokan_sound_url', $btn1_url, PDO::PARAM_STR);
        $stmt->bindValue(':nekokan_sound_flg', 0, PDO::PARAM_INT);
        $stmt->execute();

        break;

        case "03":
        $btn1_url ='sound/test3.wav';

        $stmt = $pdo -> prepare("INSERT INTO nekokan_sound (nekokan_sound_id, nekokan_sound_url, nekokan_sound_flg) VALUES (default, :nekokan_sound_url, :nekokan_sound_flg)");
        $stmt->bindParam(':nekokan_sound_url', $btn1_url, PDO::PARAM_STR);
        $stmt->bindValue(':nekokan_sound_flg', 0, PDO::PARAM_INT);
        $stmt->execute();

        break;

        case "04":
        $btn1_url ='sound/test4.wav';

        $stmt = $pdo -> prepare("INSERT INTO nekokan_sound (nekokan_sound_id, nekokan_sound_url, nekokan_sound_flg) VALUES (default, :nekokan_sound_url, :nekokan_sound_flg)");
        $stmt->bindParam(':nekokan_sound_url', $btn1_url, PDO::PARAM_STR);
        $stmt->bindValue(':nekokan_sound_flg', 0, PDO::PARAM_INT);
        $stmt->execute();

        break;

        default:

        break;

    }
}


function echo_nekokan_move_btn(){
    $retstr = '';
    $retstr =<<<END_BLOCK
    <input type="image" name="mic_btn" src="img/mic3.png" alt="マイク" width="50" height="80" onClick="" />
    <input type="button" class="rec"  width="500" height="500" value="REC" />
    <a class="download"></a>
    <audio class="audio"></audio>
    <span style="margin-right: 6em;"></span>
    <input type="image" id="btn-01" name="btn01" src="img/nikukyuu1.png" alt="ボタン１" width="80" height="80" onClick="OnButtonClick1"/>
    <input type="image" id="btn-02" name="btn02" src="img/nikukyuu2.png" alt="ボタン2" width="80" height="80" onClick="OnButtonClick2" />
    <input type="image" id="btn-03" name="btn03" src="img/nikukyuu3.png" alt="ボタン3" width="80" height="80" onClick="" />
    <input type="image" id="btn-04" name="btn04" src="img/nikukyuu4.png" alt="ボタン4" width="80" height="80" onClick="" />
    <input id="submit-value" type="hidden" name="hide_val" value=""/>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            navigator.getUserMedia =
            navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia;
            window.URL =
            window.URL ||
            window.webkitURL ||
            window.mozURL ||
            window.msURL;
            window.AudioContext =
            window.AudioContext||
            window.webkitAudioContext;
                        $('#btn-01').click(function() {
                $('#form1').submit(function() {
                    $('#submit-value').val("01");
                    // 処理
                });
            });
            $('#btn-02').click(function() {
                $('#form1').submit(function() {
                    $('#submit-value').val("02");
                    // 処理
                });
            });
            $('#btn-03').click(function() {
                $('#form1').submit(function() {
                    $('#submit-value').val("03");
                    // 処理
                });
            });
            $('#btn-04').click(function() {
                $('#form1').submit(function() {
                    $('#submit-value').val("04");
                    // 処理
                });
            });




            var stream;
            var recorder;
            var el = {
                audio : document.querySelector('.audio'),
                rec : $('.rec'),
                download: $('.download')
            }
            function event_read(el){

            }
//event_read(el);
//el.rec.('click', recControl, false);

            $('.rec').on('click',function(){
                console.log("click");
                if(typeof MediaRecorder == 'undefined') return;
                if(!stream){
                    console.log("REC clicked")
                    el.rec.val('STOP');
                    navigator.getUserMedia(
                    {
                        video: false,
                        audio: true
                    },
                    function(s){
                        console.log("録音開始");
                        stream = s;
                        recorder = new MediaRecorder(stream);
                        recorder.start();
                        recorder.ondataavailable = function(event) {
                            var blob = event.data;
                    //var blob = exportWAV(audioBufferArray, audioContext.sampleRate)
                    //var url = el.audio.src(URL.createObjectURL(blob));
                            var url = el.audio.src = URL.createObjectURL(blob);
                            el.audio.play();
                    //download link
                            el.download.attr("href", url);
                            el.download.attr("download", 'output.wav');
                            el.download.text('download');
                        };
                    },
                    function(err){
                        console.log(err.name ? err.name : err);
                    }
                    );
                }
                else{
                    console.log("録音停止");
                    console.log("再生開始");
                    el.rec.val('REC');
                    recorder.stop();
                    stream.stop();
                    stream = undefined;
                }
            });
        });
    </script>
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
                    <a href="video_list.php"><img src="img/movie_btn.png" alt="タイトル"  height="8%"></a>
                    <a href="login.php"><img src="img/logout_btn.png" alt="タイトル"  height="8%"></a>
                </div>
            </div>
            <!-- ヘッダ終了 -->
            <!-- コンテンツ開始 -->
            <div id="content">
                <CENTER>
                    <img id="video_index" src="http://nekokann.local:8081" align="center" width="675" height="513" controls></img>
                </CENTER>
            </div>
            <!-- コンテナ終了 -->
            <!-- フッタ開始 -->
            <div id="btn_b">

                <form id="form1" action="" method="post" >
                    <?php echo_nekokan_move_btn(); ?>
                </form>

            </div>

            <footer>

            </footer>

            <!-- フッタ終了 -->
        </div>
        <!-- ページ終了 -->
    </div>
    <!-- コンテナ終了 -->
</body>

</html>
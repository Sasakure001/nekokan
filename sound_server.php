<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=nekokan;charset=utf8','root','root2016',
array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$stmt = $pdo -> prepare("SELECT * FROM nekokan_sound ORDER BY nekokan_sound_id DESC");
$stmt->execute();

while ($row = $stmt->fetchObject())
{
    $nekokan_sounds[] = array(
        'nekokan_sound_id'=> $row->nekokan_sound_id
        ,'nekokan_sound_name' => $row->nekokan_sound_name
        ,'nekokan_sound_url' => $row->nekokan_sound_url
        ,'nekokan_sound_flg' => $row->nekokan_sound_flg
        );
}
    //JSON形式で出力する
    header('Content-Type: application/json');
    echo json_encode( $nekokan_sounds );
    exit;

?>
<?php
$id = $_POST['id'];
try{
$pdo = new PDO('mysql:host=localhost;dbname=nekokan;charset=utf8','root','root2016',
array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$sql = 'update nekokan_sound set nekokan_sound_flg =:flg where nekokan_sound_id = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':flg', 1, PDO::PARAM_INT);
$stmt->execute();
exit;
?>
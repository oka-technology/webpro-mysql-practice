<?php
header('Content-Type: text/html; charset=UTF-8');
try {
  $dbh = new PDO('mysql:host=db;dbname=bookdb;charset=utf8;', 'user', 'password');
  $dbh->query("set names utf8");

?>

<!DOCTYPE html>
<html lang="ja-JP">
<head>
  <meta charset="UTF-8">
  <title>input</title>
</head>
<body>
  <h1>登録</h1>
  <form action="record.php" method="post">
    <p>
      <label for="isbn">ISBN:</label>
      <input type="number" id="isbn" name="isbn">
    </p>
    <p>
      <label for="name">名前:</label>
      <input type="text" id="name" name="name">
    </p>
    <p>
      <label for="price">価格:</label>
      <input type="number" id="price" name="price">
    </p>
    <p>
      <label for="category">カテゴリ:</label>
      <select id="category" name="category">
      <?php
      $stmt = $dbh->query('SELECT * FROM categories');
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      ?>
      <option value="<?=$row['id']?>"><?=$row['name']?></option>
      <?php
      }
      ?>
      </select>
    </p>
    <p>
      <label for="author">作者:</label>
      <select name="author" id="author">
      <?php
      $stmt = $dbh->query('SELECT * FROM authors');
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      ?>
      <option value="<?=$row['id']?>"><?=$row['name']?></option>
      <?php
      }
      ?>
      </select>
    </p>
    <p>
      <label>タグ:</label>
      <?php
      $stmt = $dbh->query('SELECT * FROM tags');
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      ?>
      <input type="checkbox" name="tags[]" value="<?=$row['id']?>"><?=$row['name']?>
      <?php
      }
      ?>
    </p>
    <input type="submit">
  </form>
</body>
</html>

<?php
} catch (PDOException $e) {
  var_dump($e);
  exit;
}

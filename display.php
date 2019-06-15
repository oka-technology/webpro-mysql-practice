<?php 
header('Content-Type: text/html; charset=UTF-8');
try  {
  // SELECT 文
  $dbh = new PDO('mysql:host=db;dbname=bookdb;charset=utf8;', 'user', 'password');
  $dbh->query("set names utf8");
  $stmt_books = $dbh->query('SELECT * FROM books');
  $stmt_categ = $dbh->query('SELECT * FROM categories');
  $stmt_author = $dbh->query('SELECT * FROM authors');
?>

<!DOCTYPE html>
<html lang="ja-JP">
<head>
  <meta charset="UTF-8">
  <title>本一覧</title>
</head>
<body>
  <h1>本一覧</h1>
    <table border=1>
    <tr>
      <th>カテゴリ</th>
      <th>書籍名(ISBN)</th>
      <th>著者</th>
      <th>価格</th>
      <th>タグ</th>
    </tr>
    <?php 
    while ($row_books = $stmt_books->fetch(PDO::FETCH_ASSOC)) {
      while($row_categ = $stmt_categ->fetch(PDO::FETCH_ASSOC)) {
        if($row_categ['id'] == $row_books['category_id']){
          $category_value = $row_categ['name'];
          break;
        }
      }
      while($row_author = $stmt_author->fetch(PDO::FETCH_ASSOC)) {
        if($row_author['id'] == $row_books['author_id']){
          $author_value = $row_author['name'];
          break;
        }
      }
    ?>
    <tr>
      <td><?=$category_value?></td>
      <td><?=$row_books['name']?></br>(<?=$row_books['isbn']?>)</td>
      <td><?=$author_value?></td>
      <td><?=$row_books['price']?></br>円</td>
      <td></td>
    </tr>
    <?php } ?>
    </table>
</body>
</html>
<?php
} catch (PDOException $e) {
  var_dump($e);
  exit;
}
?>

<?php 
header('Content-Type: text/html; charset=UTF-8');
try  {
  // SELECT 文
  $dbh = new PDO('mysql:host=db;dbname=bookdb;charset=utf8;', 'user', 'password');
  $dbh->query("set names utf8");
  $stmt_books = $dbh->query('SELECT * FROM books');
  $stmt_categ = $dbh->query('SELECT * FROM categories');
  $stmt_author = $dbh->query('SELECT * FROM authors');
  $row_author = $stmt_author->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja-JP">
<head>
  <meta charset="UTF-8">
  <title>一覧</title>
</head>
<body>
  <h1>一覧</h1>
    <table>
    <tr>
      <th>カテゴリ</th>
      <th>書籍名(ISBN)</th>
      <th>著者</th>
      <th>価格</th>
      <th>タグ</th>
    </tr>
    <?php 
    $category_value = '';
    $author_value = '';
    while ($row_books = $stmt_books->fetch(PDO::FETCH_ASSOC)) {
      while($row_categ = $stmt_categ->fetch(PDO::FETCH_ASSOC)) {
        var_dump($row_books);
        var_dump($row_categ);
        if($row_categ['id'] == $stmt_categ['category_id']){
          $category_value = $row_categ['name'];
          break;
        }
      }
    // var_dump($category_value);
    ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
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

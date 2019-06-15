<?php 
header('Content-Type: text/html; charset=UTF-8');
try  {
  // SELECT 文
  $dbh = new PDO('mysql:host=db;dbname=bookdb;charset=utf8;', 'user', 'password');
  $dbh->query("set names utf8");
  $stmt_books = $dbh->query('SELECT * FROM books');
  $stmt_categ = $dbh->query('SELECT * FROM categories');
  $stmt_author = $dbh->query('SELECT * FROM authors');
  $stmt_tags = $dbh->query('SELECT * FROM tags');
  $stmt_books_tags = $dbh->query('SELECT * FROM books_tags');
  $rows_books = array();
  while($tmp = $stmt_books->fetch(PDO::FETCH_ASSOC)){
    $rows_books[] =$tmp;
  }
  while($tmp = $stmt_categ->fetch(PDO::FETCH_ASSOC)){
    $rows_categ[] =$tmp;
  }
  while($tmp = $stmt_author->fetch(PDO::FETCH_ASSOC)){
    $rows_author[] =$tmp;
  }
  while($tmp = $stmt_books_tags->fetch(PDO::FETCH_ASSOC)){
    $rows_books_tags[] =$tmp;
  }
  while($tmp = $stmt_tags->fetch(PDO::FETCH_ASSOC)){
    $rows_tags[] =$tmp;
  }
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
    foreach ($rows_books as $row_books){
      foreach ($rows_categ as $row_categ) {
        if($row_categ['id'] == $row_books['category_id']){
          $category_value = $row_categ['name'];
          break;
        }
      }
      foreach ($rows_author as $row_author) {
        if($row_author['id'] == $row_books['author_id']){
          $author_value = $row_author['name'];
          break;
        }
      }
      foreach ($rows_books_tags as $row_books_tags) {
        if($row_books_tags['books_id'] == $row_books['id']){
          foreach ($rows_tags as $row_tags){
            if($row_tags['id'] == $row_books_tags['tags_id']){
              $tag_values[] = $row_tags['name'];
              break;
            }
          }
        }
      }
    ?>
    <tr>
      <td><?=$category_value?></td>
      <td><?=$row_books['name']?><br />(<?=$row_books['isbn']?>)</td>
      <td><?=$author_value?></td>
      <td><?=$row_books['price']?><br />円</td>
      <td>
      <?php foreach ($tag_values as $tag_value) {?>
        <p><?=$tag_value?></p>
      <?php 
        }
        $tag_values = array();
      ?>
      </td>
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

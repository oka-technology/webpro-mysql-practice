<?php
  try {
    $dbh = new PDO (
      'mysql:host=db;dbname=bookdb',
      'user',
      'password'
    );
    $stmt = $dbh->query('SELECT max(id) FROM books');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $max_id_old = $row['max(id)'];

    $stmt = $dbh->prepare (
      'INSERT INTO books (isbn, name, price, category_id, author_id) VALUES (?,?,?,?,?)'
    );
    $stmt->execute(array($_POST['isbn'], $_POST['name'], $_POST['price'], $_POST['category'], $_POST['author']));

    $stmt = $dbh->query('SELECT max(id) FROM books');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);    
    $max_id_new = $row['max(id)'];
    if ($max_id_new !== $max_id_old){
      $tags = $_POST['tags'];
      foreach ($tags as $tag){
        $stmt = $dbh->prepare (
        'INSERT INTO books_tags (books_id, tags_id) VALUES (?, ?)'
        );
        $stmt->execute(array($max_id_new, $tag));
      }
    }

  } catch (PDOException $e) {
    var_dump($e);
    exit;
  }
  header( "Location: display.php") ;
	exit ;

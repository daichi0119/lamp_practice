<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>カート</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入明細</h1>
  <div class="container">

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>注文番号: <?php print($id);?></th>
            <th>購入日時: <?php print($created);?></th>
            <th>合計金額: <?php print($total_price);?>円</th>
          </tr>
        </thead>
      </table>

      <table class="table table-bordered">
        <thead>
          <thead class="thead-light">
            <tr>
              <th>商品名</th>
              <th>商品価格</th>
              <th>購入数</th>
              <th>小計</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($details as $detail){ ?>
          <tr>
            <td><?php print($detail['name']);?></td>
            <td><?php print($detail['price']);?>円</td>
            <td><?php print($detail['amount']);?></td>
            <td><?php print($detail['total']);?>円</td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
  </div>

</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; 
    ?>
    <h1>購入履歴画面</h1>

    <div class="container">
        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <?php if(count($all_history) > 0){ ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                  <th>注文番号</th>
                  <th>購入日時</th>
                  <th>注文の合計金額</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($all_history as $history){ ?>
                  <tr>
                    <td><?php print($history['id']);?></td>
                    <td><?php print($history['created']);?></td>
                    <td><?php print ($history['total']);?>円</td>
                    <td>
                      <form method="post" action="details.php">
                          <input type="submit" value="購入明細">
                          <input type="hidden" name="id" value="<?php print($history['id']);?>">
                          <input type="hidden" name="created" value="<?php print($history['created']);?>">
                          <input type="hidden" name="total" value="<?php print($history['total']);?>">
                      </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
          <p>購入履歴はありません。</p>
        <?php } ?>
    </div>

</body>
</html>
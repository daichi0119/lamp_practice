<?php
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// dbデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'db.php';

// ユーザー毎の購入履歴
function get_history_user_id($db, $user_id) {
    $sql = "
      SELECT
        history.id,
        history.created,
        SUM(details.price * details.amount) AS total
      FROM
        history
      JOIN
        details
      ON
        history.id = details.history_id
      WHERE
        user_id = ?
      GROUP BY
        history.id
      ORDER BY
        history.id DESC
    ";
    return fetch_all_query($db, $sql, array($user_id));
}

// 全ユーザーの購入履歴を取得(adminユーザー)
function get_history($db) {
  $sql = "
    SELECT
      history.id,
      history.created,
      SUM(details.price * details.amount) AS total
    FROM
      history
    JOIN
      details
    ON
      history.id = details.history_id
    GROUP BY
      history.id
    ORDER BY
      history.id DESC
  ";
  return fetch_all_query($db, $sql);
}

// adminユーザー(user_id:4)の場合は全ての履歴を閲覧することができる
function get_all_history($db, $user_id){
  if($user_id ===  4){
    return get_history($db);
  } else {
    return get_history_user_id($db, $user_id);
  }
}

// ユーザー毎の購入明細(ログインしているユーザーが購入したアイテム名、価格、購入数、合計金額)
function get_details($db, $id) {
  $sql = "
    SELECT
      items.name,
      details.price,
      details.amount,
      details.price * details.amount AS total
    FROM
      details
    JOIN
      items
    ON
      items.item_id = details.item_id
    WHERE
      history_id = ?
  ";
  return fetch_all_query($db, $sql, array($id));
}

// 購入明細から合計金額を取得
function sum_purchase($details){
  $total_price = 0;
  foreach($details as $detail){
    $total_price += $detail['price'] * $detail['amount'];
  }
  return $total_price;
}
<?php
// 変数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
// itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';
// cartデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'cart.php';
// orderデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'order.php';

// ログインチェックを行うため、セッション開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === false){
  // ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// PDOを取得
$db = get_db_connect();
// PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);

// PDOを利用してログインユーザーのカートデータを取得
$carts = get_user_carts($db, $user['user_id']);

// 購入履歴、購入明細のトランザクション

  // トランザクションの開始
  $db->beginTransaction();
  try {
  insert_history($db, $user['user_id']);
  $id = $db->lastInsertId();
  foreach($carts as $cart) {
    insert_details($db, $id, $cart['item_id'], $cart['price'], $cart['amount']);
  }
  // コミット処理
  $db->commit();
}catch(PDOException $e){
  // ロールバック処理
  $db->rollback();
  set_error($e->getMessage());
}

// ログインユーザーとカートデータに誤りがあった際のエラーチェック
if(purchase_carts($db, $carts) === false){
  set_error('商品が購入できませんでした。');
  // カートページにリダイレクト
  redirect_to(CART_URL);
} 

// 合計金額を取得
$total_price = sum_carts($carts);

// ビューの読み込み
include_once '../view/finish_view.php';
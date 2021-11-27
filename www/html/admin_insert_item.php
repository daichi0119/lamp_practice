<?php
// 変数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
// itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';

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

// 管理ユーザー(admin)ではない場合、ログインページにリダイレクトする
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

// nameをPOST値で取得
$name = get_post('name');
// priceをPOST値で取得
$price = get_post('price');
// statusをPOST値で取得
$status = get_post('status');
// stockをPOST値で取得
$stock = get_post('stock');
// imageをPOST値で取得
$image = get_file('image');

// トークンを取得
$token = get_post('token');

// 商品登録とエラーチェック
if(is_valid_csrf_token($token)){
  if(regist_item($db, $name, $price, $stock, $status, $image)){
    set_message('商品を登録しました。');
  }else {
    set_error('商品の登録に失敗しました。');
  }
  }else {
    set_error('不正な操作が行われました。');
  }


// adminページにリダイレクト
redirect_to(ADMIN_URL);
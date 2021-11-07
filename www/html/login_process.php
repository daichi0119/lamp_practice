<?php
// 変数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';

// ログインチェックを行うため、セッション開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === true){
  // ログインが成功した場合はホームページにリダイレクト
  redirect_to(HOME_URL);
}

// nameをPOST値で取得
$name = get_post('name');
// passwordをPOST値で取得
$password = get_post('password');

// PDOを取得
$db = get_db_connect();


// PDO,name,passwordを利用してログインユーザーのデータを取得
$user = login_as($db, $name, $password);
// ログインに失敗した場合の処理
if( $user === false){
  set_error('ログインに失敗しました。');
  // ログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

// ログインに成功した場合の処理
set_message('ログインしました。');
// ログインされたのがadminである場合
if ($user['type'] === USER_TYPE_ADMIN){
  // 管理ページにリダイレクト
  redirect_to(ADMIN_URL);
}
// ホームページにリダイレクト
redirect_to(HOME_URL);
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
// password_confirmation(確認用パスワード)をPOST値で取得
$password_confirmation = get_post('password_confirmation');

// PDOを取得
$db = get_db_connect();

try{
  // PDOとPOST値を利用して新規登録ユーザーのデータ取得
  $result = regist_user($db, $name, $password, $password_confirmation);
  // 新規登録に失敗した場合にエラーを返す
  if( $result=== false){
    set_error('ユーザー登録に失敗しました。');
    // 新規登録ページにリダイレクト
    redirect_to(SIGNUP_URL);
  }
 // 例外エラー
}catch(PDOException $e){
  set_error('ユーザー登録に失敗しました。');
  // 新規登録ページにリダイレクト
  redirect_to(SIGNUP_URL);
}

// 新規登録に成功した場合のメッセージ
set_message('ユーザー登録が完了しました。');
login_as($db, $name, $password);
// ホームページにリダイレクト
redirect_to(HOME_URL);
<?php
// 変数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
// itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';
// rankingデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'ranking.php';

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

// PDOを利用して開いたアイテムのデータを取得
$items = get_open_items($db);

// データベースからランキング情報を取得
$ranking = get_ranking($db);

// ビューの読み込み
include_once VIEW_PATH . 'index_view.php';
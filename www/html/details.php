<?php
// 変数ファイルを読み込み
require_once '../conf/const.php';
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
// itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';
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

// ログインしているuser_idを取得
$user_id = get_session('user_id');

// POST値でIDを取得
$id = get_post('id');
// POST値で日付を取得
$created = get_post('created');
// POST値で小計を取得
$total = get_post('total');

// 購入明細を取得
$details = get_details($db, $id);
// 合計金額を取得
$total_price = sum_purchase($details);

//ビューの読み込み
include_once VIEW_PATH . '../view/detail_view.php';
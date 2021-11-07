<?php
// 変数ファイルを読み込み
require_once '../conf/const.php';
// 汎用変数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';

// ログインチェックを行うため、セッション開始する
session_start();

// ログインチェック用関数を利用
if(is_logined() === true){
  // ログインが成功した場合はホームページにリダイレクト
  redirect_to(HOME_URL);
}

// ビューの読み込み
include_once VIEW_PATH . 'signup_view.php';




<?php
// 汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
// dbデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'db.php';

// ランキング情報を取得するSQL文
function get_ranking($db){
    $sql = "
      SELECT
        items.name,
        items.image,
        SUM(amount) as total
      FROM
        details
      JOIN
        items
      ON
        items.item_id = details.item_id
      GROUP BY
        details.item_id
      ORDER BY
        total DESC
      LIMIT 3
      ";

      return fetch_all_query($db,$sql);
}
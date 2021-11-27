-- 購入履歴画面テーブル history
CREATE TABLE history (
    id INT AUTO_INCREMENT,
    user_id INT,
    created DATETIME,
    primary key(id)
);

-- 購入明細画面テーブル　details
CREATE TABLE details (
    id INT AUTO_INCREMENT,
    history_id INT,
    price INT,
    item_id INT,
    amount INT DEFAULT 0,
    primary key(id)
);
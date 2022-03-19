# データベース設計

## usersテーブル
| Column               | Type       | Options                        |
| ------               | ---------- | ------------------------------ |
| nickname             | string     | null: false                    |
| email                | string     | null: false, unique: true      |
| encrypted_password   | string     | null: false                    |
| profile              | text       | null: false                    |
| birthday             | date       | null: false                    |
| prefecture_id        | integer    | null: false                    |

### Association
- has_many :posts
- has_many :comments
- extend ActiveHash::Associations::ActiveRecordExtensions
- belongs_to :prefecture

## postsテーブル
| Column               | Type       | Options                        |
| ------               | ---------- | ------------------------------ |
| ku                   | string     | null: false                    |
| description          | text       | null: false                    |
| image                | text       | null: false                    |
| user_id              | references | null: false, foreign_key: true |

### Association
- belongs_to :user

## commentsテーブル
| Column               | Type       | Options                        |
| ------               | ---------- | ------------------------------ |
| text                 | text       | null: false                    |
| user_id              | references | null: false, foreign_key: true |

### Association
- belongs_to :user

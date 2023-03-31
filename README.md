# 初期準備

## 利用技術

-   Laravel 10
-   MySQL 8
-   Mailpit
-   nginx
-   vite

## PHP ライブラリの install

```
docker compose exec app bash
```

でコンテナの中に入る。
コンテナに入れたら、入った直後のカレントディレクトリで composer install を実行

## .env を設定

.env ファイルの中の下記をご利用の環境に合わせて変更してください。

-   DB_CONNECTION=mysql
-   DB_HOST=db
-   DB_PORT=3306
-   DB_DATABASE=laravel_local
-   DB_USERNAME=phper
-   DB_PASSWORD=secret

## 推奨拡張機能を追加

推奨機能の拡張機能をインストールしておいてください。

## フォーマッター

PHP は PHP Intelephense
JS は Prettier
に設定しておいてください。

## DB 作成

```
docker-compose exec db /bin/bash
mysql -u root -p
```

パスワードは secret

```
create database laravel_local;
GRANT ALL ON laravel_local.\* TO phper;
```

## db との疎通確認

```
docker-compose exec app bash
php artisan tinker
```

のうえ、以下を実行。

```
DB::select('select 1');
```

結果が返ってくれば OK。
エラーの場合は[これ](https://qiita.com/ucan-lab/items/20a5a6ad7faea7cd622f)を参考に。

## マイグレーションの実施

```
docker-compose exec app bash
php artisan migrate:fresh --seed
```

と実行してください。(データベーステーブルとダミーデータが追加されれば OK)

## 仕上げ

```
npm run build
php artisan key:generate
```

と入力してキーを生成後、

http:127.0.0.1:8080

より確認。

## opcache の追加

[参考 1 opcache ってそもそも何](https://qiita.com/ucan-lab/items/850bfd3afd3cc0fff60f)
[参考 2 php.ini の設定](https://www.php.net/manual/ja/opcache.installation.php)
[参考 3 docker に放り込む方法](https://blog.bassbone.tokyo/archives/1125)

## xDebug の追加

[参考](https://ichi-station.com/php-xdebug-vscode-docker/)

# そのほか備忘録

## コンテナに入る

```
docker compose exec app bash
docker compose exec web bash
```

## root 権限で DB を操作したい

```
docker-compose exec db /bin/bash
mysql -u root -p
```

パスワードは secret

## 指定したマイグレーションファイルのみ実行する

[参考](https://takuya-1st.hatenablog.jp/entry/2019/09/18/184255)

```
php artisan migrate:refresh --step=1  --path=/database/migrations/2022_08_10_000000_create_publishers_table.php
```

## 特定のシーダーのみ実行する

[参考](https://qiita.com/niiyz/items/c36191fc2c5d48e7e544)

```
php artisan db:seed --class=PublisherSeeder
```

## モデルの作成

[参考](https://qiita.com/niisan-tokyo/items/9c799989cb535489f201)

```
php artisan make:model Publisher
```

## Rest Client が文字化けするときの対処法

https://qiita.com/gungungggun/items/4bb1c9bb0c3114354014

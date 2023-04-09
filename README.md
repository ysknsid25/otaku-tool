# Otaku Tool

超 A&G の放送情報を声優もしくは番組情報から検索し、通知対象を登録します。

![image](https://user-images.githubusercontent.com/44870505/230750519-4cf92524-fd06-4aca-a302-cd3e37162fcf.png)

登録した番組情報のうち、その日配信されている番組を、毎日一定の時間にメールでまとめてお知らせすることができます。

![image](https://user-images.githubusercontent.com/44870505/230750506-9147165c-66eb-4d38-9b04-efe3f91cec46.png)


# Author

[Kanon](https://www.resume.id/kanon1225)

# 初期準備(Web)

## 0. 利用技術

-   Laravel 10
-   PHP 8
-   MySQL 8
-   mailpit
-   nginx
-   vite
-   SendGrid
-   Google Cloud Functions

## 1. PHP ライブラリの install

```
docker compose exec app bash
```

でコンテナの中に入る。
コンテナに入れたら、入った直後のカレントディレクトリで composer install を実行

## 2. .env を設定

.env ファイルの中の下記をご利用の環境に合わせて変更してください。

-   DB_CONNECTION=mysql
-   DB_HOST=db
-   DB_PORT=3306
-   DB_DATABASE=laravel_local
-   DB_USERNAME=phper
-   DB_PASSWORD=secret

## 3. 推奨拡張機能を追加

推奨機能の拡張機能をインストールしておいてください。

## 4. フォーマッター

PHP は PHP Intelephense
JS は Prettier
に設定しておいてください。

## 5. DB 作成

```
docker-compose exec db /bin/bash
mysql -u root -p
```

パスワードは secret

```
create database laravel_local;
GRANT ALL ON laravel_local.\* TO phper;
```

## 6. db との疎通確認

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

## 7. マイグレーションの実施

```
docker-compose exec app bash
php artisan migrate:fresh --seed
```

と実行してください。(データベーステーブルとダミーデータが追加されれば OK)

## 8. 仕上げ

```
npm run build
php artisan key:generate
```

と入力してキーを生成後、

http:127.0.0.1:8080

より確認。

## 10. xDebug の追加

[参考](https://ichi-station.com/php-xdebug-vscode-docker/)

launch.json は以下のように対応する。

```
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "pathMappings": {
                "/framework":"${workspaceRoot}/framework"
            }
        },
```

# バッチ環境

このプロジェクトの前身で稼働していたプログラムを、当プロジェクトにマージする形で用意しています。

バッチ環境については、別途[README](./batch/README.md)をご参照ください。

# コントリビューション

みなさまからのコントリビューションを歓迎しています。

コントリビュートの際には、事前に[コントリビュートの流れ](./CONTRIBUTING.md)と[行動規範](./CODE_OF_CONDUCT.md)をご一読ください。

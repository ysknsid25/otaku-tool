# 概要

このプロジェクトを始める以前の A&G 番組情報取得プログラムと、メール配信プログラムは Google Cloud Functions で稼働していました。

ユーザーインターフェースについては Google サービス上で稼働させていますが、バッチプログラムについては引き続き Google Cloud Functions にて稼働させる前提で作成する。

# 技術構成

素の Python 3.10 を利用。

# 環境構築

## 依存ライブラリのインストール

requirements.txt のライブラリをインストール。

```
cd batch
pip install -r requirements.txt
```

## 設定ファイルの用意

.env.yaml.example を.env.yaml としてコピーする。

docker-compose.yml を変更していない限り、そのままコピーするだけで OK。

なお、データベースは Laravel の Docker と共有しているため、プロジェクトのトップディレクトリで docker-compose しておく必要がある。

## エミュレーターの用意

Cloud Functions エミュレーターを利用してローカルでテストを行う。

基本的には main.py の test 関数が http 関数となっているので、その中にプログラムを記述する。

テストは以下のコマンドから実行する。

```
cd batch
functions-framework --target=<関数名>
```

ブラウザからアクセスすることで実行される。

```
http://localhost:8080/<関数名>
```

# テストコードの実行

テスト対象のフォルダが増えた場合、[test.sh](./test.sh)にフォルダを追加する。

```
sh test/test.sh
```

全てのテストを実行する

```
python -m unittest discover test -v
```

一つのテストケースだけを実行する

```
python -m unittest test.test -v
```

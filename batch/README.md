# 構成

[システム構成図](https://drive.google.com/file/d/1EkEkk8OExyIm98BaXlKc7tN9hsu7Ay81/view?usp=sharing)

# Python ランタイム

[Google の環境構築手順](https://cloud.google.com/python/docs/setup?hl=ja)を参考に構築。

# 関数のデプロイ(http)

```
gcloud functions deploy get_agonair_info --region=asia-northeast2 --runtime python310 --service-account ag-onairinfo-writer@adnag-371706.iam.gserviceaccount.com --env-vars-file .env.yaml --trigger-http
```

# 関数のデプロイ(pub/sub)

```
gcloud functions deploy get_agonair_info_pubsub --region=asia-northeast2 --trigger-event=providers/cloud.pubsub/eventTypes/topic.publish --trigger-resource=agnotify-functions-trigger --runtime python310 --service-account ag-onairinfo-writer@adnag-371706.iam.gserviceaccount.com --env-vars-file .env.yaml
```

# Cloud Functions を定期実行する方法

[このサイト](https://dev.classmethod.jp/articles/try-cloud-functions-scheduler-pubsub/)が参考になった

# ローカルでの実行

最初だけこれを入れる

```
pip3 install functions-framework
```

このコマンドを実行する。

```
cd ./batch
functions-framework --target=<関数名>
```

エミュレートが始まるので、ここにアクセスする。

```
http://localhost:8080
```

# テストコードの実行

コンテナの中に入ってこれを実行。
テスト対象のフォルダが増えた場合、このシェルファイルにフォルダを追加する。

```
cd /var/dockerpython
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

# CI/CD

github actions を利用する。
[CD についてはこの記事](https://blog.ojisan.io/gha-gcloud/)を参考。
このため、サービスアカウント用の鍵情報などは github Secret に保存している。
けど、本当は workload identity を使う方が良い。
使わない場合、アカウント情報が IAM と github Actions(こっちは秘密鍵とかの情報)の二つに分散してしまう。
使う場合は、workload Identity に認証情報を聞きに行けばいいので、GCP 内に情報を止めることができる。

github secrets に保存する内容は base64 でエンコードされていないとダメなので、エンコードしてあげる。

```
base64 -i adnag-371706-2874acbb8113.json -o adnag-371706-2874acbb8113_base64.txt
```

## サービスアカウントの対応表

[対応表](https://mokicks.hatenablog.com/entry/2018/09/13/014615)

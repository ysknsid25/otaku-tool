FROM mysql/mysql-server:8.0

ENV MYSQL_DATABASE=laravel_local \
    MYSQL_USER=phper \
    MYSQL_PASSWORD=secret \
    MYSQL_ROOT_PASSWORD=secret \
    TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
# どうもwindowsでボリュームマウントすると権限が777になってしまうみたい
# 書き込み権限がついてるとMySQL起動時にエラーになるので644に変更している
RUN chmod 644 /etc/my.cnf
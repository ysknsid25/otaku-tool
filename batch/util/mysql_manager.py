import mysql.connector
import yaml
from util import batchutil
import os

def get_connection():
    """
    MySQLへの接続を取得する
    """
    MYSQL_HOST_KEY = 'MYSQL_HOST'
    MYSQL_USER_KEY = 'MYSQL_USER'
    MYSQL_PASSWORD_KEY = 'MYSQL_PASSWORD'
    MYSQL_DATABASE_KEY = 'MYSQL_DATABASE'
    MYSQL_PORT_KEY = 'MYSQL_PORT'
    if batchutil.is_runtime_cloudfunctions():
        host=os.getenv(MYSQL_HOST_KEY) 
        user=os.getenv(MYSQL_USER_KEY)
        password=os.getenv(MYSQL_PASSWORD_KEY)
        database=os.getenv(MYSQL_DATABASE_KEY) 
        port=os.getenv(MYSQL_PORT_KEY)
    else:
        with open('.env.yaml', 'r') as yml:
            config = yaml.safe_load(yml)
        host=config[MYSQL_HOST_KEY] 
        user=config[MYSQL_USER_KEY] 
        password=config[MYSQL_PASSWORD_KEY] 
        database=config[MYSQL_DATABASE_KEY] 
        port=config[MYSQL_PORT_KEY]
    connection = mysql.connector.connect(host=host,user=user,password=password,database=database, port=port)
    return connection

def connection_close(connection):
    """
    MySQLから切断する
    """
    connection.close()
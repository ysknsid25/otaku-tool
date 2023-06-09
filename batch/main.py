from flask import escape
import functions_framework
from agscraiping import scraiping
from agscraiping import mysql
from agscraiping import sendmail
from util import mysql_manager
import requests

spurl="https://docs.google.com/spreadsheets/d/1u8Css_p_vk6UY65flm6e0aL6IPciysp8l2hXWHB6058/edit#gid=0"
def get_agonair_info_pubsub(event, context):
  """HTTP Cloud Function.
  Returns:
      スクレイピングにより番組情報が取得できた場合は"Success", そうでなければ"Error"
  """
  onair_info=[{} for i in range(7)]
  _BASE_URL = "https://www.joqr.co.jp/qr/agdailyprogram/?date="
  onairinfo_dates=scraiping.get_onairinfo_dates()
  #print(onairinfo_dates)
  for weekday in range(len(onairinfo_dates)):
    target_date=onairinfo_dates[weekday]
    url=_BASE_URL+target_date
    response=requests.get(url)
    response.encoding = response.apparent_encoding
    lines=response.text.splitlines()
    onair_info[weekday]=scraiping.get_onair_info(lines)
  #print(onair_info)
  mysql.write_mysql_database(onair_info)
  return "Success"

def ag_onair_info_send_mail(event, context):
  """Pub/Sub Cloud Function.
  Returns:
      メール送信が成功したら、202
  """
  sendmail.send_onair_info()
  return "fine"

@functions_framework.http
def test(request):
  out="It works!"
  con = mysql_manager.get_connection()
  print(con)
  mysql_manager.connection_close(con)
  print(out)
  return out
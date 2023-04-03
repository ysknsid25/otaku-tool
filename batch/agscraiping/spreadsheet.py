from util import secretmanager
import datetime

def write_spread_sheet(onair_info:dict, spurl:str):
  """write_spread_sheet
    Args:
      onair_info:取得した番組情報
    公式ドキュメント:
      https://docs.gspread.org/en/latest/index.html
    参考:
      一括書き込みの例A1,B1=1,2
      ws.update('A1:B2', [[1, 2], [3, 4]])
      読み取りの例
      print(ws.acell('A1').value)
  """
  gc=secretmanager.get_spreadsheet_auth('PROJECT_ID','SECRET_ID','VERSION_ID','SECRET_KEY')
  sps=gc.open_by_url(spurl)
  ws=sps.sheet1
  ws.batch_clear(["C3:G503"])
  write_vals=format_onair_info(onair_info)
  #print(write_vals)
  #print(len(write_vals))
  row=len(write_vals)+2
  write_range="C3:G"+str(row)
  ws.update(write_range, write_vals)

def format_onair_info(onair_info:dict)->list:
  """write_spread_sheet
    Args:
      onair_info:取得した番組情報
    一括書き込みが可能な形に番組情報を成形する
  """
  res=[]
  weekday_list=["Mon","Tue","Wed","Thu","Fri","Sut","Sun"]
  for weekday in range(7):
    strweekday=weekday_list[weekday]
    day_onair_infoes=onair_info[weekday]
    for info in day_onair_infoes:
      tmp=[]
      tmp.append(strweekday)
      tmp.append(info["begin"])
      tmp.append(info["end"])
      tmp.append(info["title"])
      tmp.append(",".join(info["personality"]))
      res.append(tmp)
  return res

def get_onair_info(spurl:str)->dict:
  """get_onair_info
    メール送信を行うにあたって必要な情報を取得する
  """
  gc=secretmanager.get_spreadsheet_auth('PROJECT_ID','SECRET_ID','VERSION_ID','SECRET_KEY')
  sps=gc.open_by_url(spurl)
  ws=sps.sheet1
  onair_info=get_notify_onair_info(ws)
  res={}
  res["to"]=get_notify_target_email(ws)
  res["fr"]="agnotify@agnotify.com"
  res["frnm"]="A&G番組通知Bot"
  res["sub"]=str(datetime.date.today())+"のA&G放送情報"
  res["text"]="\r\n ".join(onair_info)
  res["html"]="<br />".join(onair_info)
  #print(res)
  return res 

def get_notify_target_email(ws)->str:
  """get_notify_target_email
  スプレッドシートに記載された通知対象メールアドレスを取得する
  """
  email=ws.acell('B1').value
  return email

def get_notify_onair_info(ws)->str:
  """get_notify_onair_info
  スプレッドシートに記載された通知対象番組情報を取得する
  """
  res=[]
  weekday_list=["Mon","Tue","Wed","Thu","Fri","Sut","Sun"]
  weekday=weekday_list[datetime.date.today().weekday()]
  cell=ws.find(weekday)
  now=cell.row
  cell_values=ws.row_values(now)
  #値が入ってれば->['', 'FALSE', 'Mon', '6:00', '7:00', 'A&G ARTIST ZONE樋口楓のTHE CATCH【動】', '樋口楓（VTuber）']
  #値が入ってなければ->['', 'FALSE']
  #! 短時間に60件程度しかまとめて取得できないので、曜日を見つけてから探す
  #! 公式ドキュメントには一括取得の方法が書かれていない…
  while len(cell_values)==7:
    is_notify_target = cell_values[1]
    onair_weekday=cell_values[2]
    if onair_weekday != weekday:
      break
    if is_notify_target == "FALSE":
      now+=1
      cell_values=ws.row_values(now)
      continue
    info=cell_values[3]+"〜"+cell_values[4]+" "+cell_values[5]+"："+cell_values[6]
    res.append(info)
    now+=1
    cell_values=ws.row_values(now)
  #print(res)
  return res
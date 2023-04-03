import datetime

def get_onair_info(lines: str)->list:
  """get_onair_info
  Args:
    lines: GETにより取得したA&Gの一日分の放送データ
  Returns:
      一日分の放送データを解析して取得した番組情報
      開始時間、終了時間、番組名、パーソナリティを返す。
  """
  onair_info=[]
  info={}
  for row in range(len(lines)):
    line=lines[row]
    if has_all_onair_info(info):
      #print(info)
      onair_info.append(info)
      info={}
    if line.find("dailyProgram-itemHeaderTime")>-1:
      info=get_time(lines[row], info)
    if line.find("dailyProgram-itemTitle")>-1:
      info=get_title(lines[row+1], info)
    if line.find("dailyProgram-itemPersonality")>-1:
      info=get_personality(lines[row+1], info)
  #最後の1回を考慮
  if has_all_onair_info(info):
    onair_info.append(info)
  return onair_info

def has_all_onair_info(info:dict)->bool:
  """get_onair_info
  Args:
    info: 番組情報
  Returns:
    全ての番組情報が取得されている場合、True。そうでなければFalse
  """
  has_begin="begin" in info
  has_end="end" in info
  has_title="title" in info
  has_personality="personality" in info
  res=has_begin and has_end and has_title and has_personality
  return res

def get_time(line:str, info:dict)->dict:
  """get_time
  Args:
    line: GETで取得したデータ1行分
    info: 戻り値用番組情報
  Returns:
    放送開始時刻と終了時刻
  """
  times=get_html_content(line)
  split_times=times.split("–")
  begin=split_times[0].strip()
  end=split_times[1].strip()
  info["begin"]=begin
  info["end"]=end
  return info

def get_title(line: str, info:dict)->dict:
  """get_title
  Args:
    line: GETで取得したデータ1行分
    info: 戻り値用番組情報
  Returns:
    番組タイトル
  """
  line=line.strip()
  title=get_html_content(line)
  #余計なもんが残るので取り除く
  title=title.replace('<i class="icon_program-movie">', "【動】")
  title=title.replace('<i class="icon_program-live">', "【生】")
  info["title"]=title
  return info

def get_personality(line: str, info:dict)->dict:
  """get_personality
  Args:
    line: GETで取得したデータ1行分
    info: 戻り値用番組情報
  Returns:
    番組パーソナリティ
  """
  personalities=[]
  sublines=line.split(",")
  for subline in sublines:
    #! elseはパーソナリティの紹介ページがない人の考慮
    if subline.find("<a")>-1:
      personality=get_html_content(subline)
    else:
      subline=subline.replace("</p>","")
      subline=subline.strip()
      personality=subline
    personalities.append(personality)
  info["personality"]=personalities
  return info

def get_html_content(line):
  """get_html_content
  Args:
    line: GETで取得したデータ1行分
  Returns:
    htmlタグで囲まれた間に存在するコンテンツを取得する。
  """
  begin=line.find('">')
  if begin > -1:
    begin+=2
  end=line.find('</')
  content=line[begin:end]
  return content

def get_onairinfo_dates()->list:
  """get_onairinfo_dates
  Returns:
    取得OnAir情報の曜日と日付を返す
  """
  res=["" for i in range(7)]
  now=datetime.datetime.now()
  today=datetime.date.today()
  weekday=today.weekday()
  for i in range(7):
    tomorrow=now+datetime.timedelta(days=i)
    tomorrow=str(tomorrow.year)+str(tomorrow.month).zfill(2)+str(tomorrow.day).zfill(2)
    tomorrow_weekday=(weekday+i)%7
    res[tomorrow_weekday]=tomorrow
  return res
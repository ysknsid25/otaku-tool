import requests

def get_weather_info(locale_ids:list)->dict:
  """get_weather_info
    地域IDに対する気象情報を取得する
  """
  res=[]
  _BASE_URL="https://weather.tsukumijima.net/api/forecast/city/"
  for locale_id in locale_ids:
    url=_BASE_URL+locale_id
    response=requests.get(url)
    response.encoding = response.apparent_encoding
    info=response.json()
    #print(info)
    res.append(info)
  return res

def get_locale_ids()->list:
  """get_locale_ids
    気象情報を取得するために必要な地域IDを返す
  """
  #神戸と東京
  res=["280010","130010"]
  return res

def get_mail_message(w_info:dict)->str:
  """get_mail_message
    気象情報を文字列にして返す
  """
  messages=[]
  for info in w_info:
    messages.append("【" + info["title"] + "】")
    todayForecast = info["forecasts"][0]
    messages.append(todayForecast["detail"]["weather"])
    messages.append(todayForecast["temperature"]["max"]["celsius"] + "°C")
    messages.append(todayForecast["chanceOfRain"]["T00_06"]+" | "+todayForecast["chanceOfRain"]["T06_12"]+" | "+todayForecast["chanceOfRain"]["T12_18"]+" | "+todayForecast["chanceOfRain"]["T18_24"])
    messages.append(" ")
    messages.append(" ")
  #print(messages)
  return messages
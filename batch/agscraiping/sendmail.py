import datetime
from agscraiping import mysql
from util import sendmail

def send_onair_info():
    """send_onair_info
        ユーザーへのメール送信処理
    """
    weekday = datetime.date.today().weekday()
    targetUsers = mysql.get_notify_target_users()
    for user in targetUsers:
        user_id = user["id"]
        email = user["email"]
        onair_info = []
        target_programs=mysql.get_notify_programs(user_id, weekday)
        for target_program in target_programs:
            program_id = target_program["id"]
            programnm = target_program["programnm"]
            onairTime = target_program["onairTime"]
            actors = mysql.get_notify_actors(program_id)
            actorNames = []
            for actor in actors:
                actorNames.append(actor["name"])
            actorName = ",".join(actorNames)
            onair_info.append(onairTime + " " + programnm + ":" + actorName)
        mailinfo={}
        mailinfo["to"]=email
        mailinfo["fr"]="agnotify@agnotify.com"
        mailinfo["frnm"]="A&G番組通知Bot"
        mailinfo["sub"]=str(datetime.date.today())+"のA&G放送情報"
        mailinfo["text"]="\r\n".join(onair_info)
        mailinfo["html"]="<br />".join(onair_info)
        #print(res)
        result_code = sendmail.sendMail(mailinfo)
        if result_code != 202:
            print("メール送信に失敗しました。")
            print("result_code:" + str(result_code))
            print("email:" + email)

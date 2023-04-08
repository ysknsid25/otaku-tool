import datetime
from util import mysql_manager
from util import batchutil

def write_mysql_database(onair_info_weekday:list):
    """
    A&Gから取得した番組情報をMySQLに登録する
    """
    #接続
    con = mysql_manager.get_connection()
    cur = con.cursor()

    #既存の番組情報を削除
    cur.execute("SELECT id, weekday, begintime, endtime, programnm FROM programs ORDER BY weekday, begintime")
    rows = cur.fetchall()
    for row in rows:
        for weekday in range(0,7):
            onair_info = onair_info_weekday[weekday]
            for onair in onair_info:
                if row[1] == weekday and row[2] == onair['begin'] and row[3] == onair['end'] and row[4] == onair['title']:
                    continue
                else:
                    cur.execute("DELETE FROM programs WHERE weekday = %s AND begintime = %s AND endtime = %s AND programnm = %s", (row[1], row[2], row[3], row[4]))
    con.commit()

    #番組情報を問い合わせる。存在しない場合は登録
    for weekday in range(0,7):
        onair_info = onair_info_weekday[weekday]
        for onair in onair_info:
            cur.execute("SELECT id FROM programs WHERE weekday = %s AND begintime = %s AND endtime = %s AND programnm = %s", (weekday, onair['begin'], onair['end'], onair['title']))
            row = cur.fetchone()
            if row is None:
                cur.execute("INSERT INTO programs (weekday, begintime, endtime, programnm, created_at, updated_at) VALUES (%s, %s, %s, %s, %s, %s)", (weekday, onair['begin'], onair['end'], onair['title'], datetime.datetime.now(), datetime.datetime.now()))
    con.commit()

    #声優情報を問い合わせる。存在しない場合は登録
    for weekday in range(0,7):
        onair_info = onair_info_weekday[weekday]
        for onair in onair_info:
            for personality in onair['personality']:
                cur.execute("SELECT id FROM actors WHERE name = %s", (personality,))
                row = cur.fetchone()
                if row is None:
                    cur.execute("INSERT INTO actors (name, created_at, updated_at) VALUES (%s, %s, %s)", (personality, datetime.datetime.now(), datetime.datetime.now()))
    con.commit()

    #パーソナリティ情報を作成する。
    for weekday in range(0,7):
        onair_info = onair_info_weekday[weekday]
        for onair in onair_info:
            cur.execute("SELECT id FROM programs WHERE weekday = %s AND begintime = %s AND endtime = %s AND programnm = %s", (weekday, onair['begin'], onair['end'], onair['title']))
            row = cur.fetchone()
            if row is None:
                continue
            programs_id = row[0]
            for personality in onair['personality']:
                cur.execute("SELECT id FROM actors WHERE name = %s", (personality,))
                row = cur.fetchone()
                if row is None:
                    continue
                actors_id = row[0]
                #personalititesテーブルに登録されているか確認
                cur.execute("SELECT id FROM personalities WHERE programs_id = %s AND actors_id = %s", (programs_id, actors_id))
                row = cur.fetchone()
                if row is None:
                    cur.execute("INSERT INTO personalities (programs_id, actors_id, created_at, updated_at) VALUES (%s, %s, %s, %s)", (programs_id, actors_id, datetime.datetime.now(), datetime.datetime.now()))
    con.commit()

    #切断
    cur.close()
    mysql_manager.connection_close(con)

def get_notify_target_users()->list:
    """
    メール送信にあたって通知対象のユーザー情報を取得する
    """
    users=[]
    con = mysql_manager.get_connection()
    cur = con.cursor()
    cur.execute("SELECT id, email FROM users WHERE email_verified_at is not null")
    rows = cur.fetchall()
    for row in rows:
        userInfo={}
        userInfo["id"]=row[0]
        userInfo["email"]=row[1]
        users.append(userInfo)
    cur.close()
    mysql_manager.connection_close(con)
    return users

def get_notify_programs(user_id: int, weekday: int)->list:
    """
    メール送信にあたってユーザーの、その曜日の通知対象の番組情報を取得する
    """
    programs=[]
    con = mysql_manager.get_connection()
    cur = con.cursor()
    cur.execute("SELECT programs.* FROM notifyprograms INNER JOIN programs ON notifyprograms.programs_id = programs.id AND notifyprograms.users_id = %s AND programs.weekday = %s", (user_id, weekday))
    rows = cur.fetchall()
    for row in rows:
        betinTime = batchutil.fomat_int_time_to_str(row[2])
        endTime = batchutil.fomat_int_time_to_str(row[3])
        programInfo={}
        programInfo["id"]=row[0]
        programInfo["programnm"]=row[1]
        programInfo["onairTime"]=betinTime + "～" + endTime
        programs.append(programInfo)
    cur.close()
    mysql_manager.connection_close(con)
    return programs

def get_notify_actors(program_id: int)->list:
    """
    メール送信にあたって通知対象の声優情報を取得する
    """
    actors=[]
    con = mysql_manager.get_connection()
    cur = con.cursor()
    cur.execute("SELECT actors.* FROM personalities INNER JOIN actors ON personalities.actors_id = actors.id AND personalities.programs_id = %s", (program_id,))
    rows = cur.fetchall()
    for row in rows:
        actorInfo={}
        actorInfo["id"]=row[0]
        actorInfo["name"]=row[1]
        actors.append(actorInfo)
    cur.close()
    mysql_manager.connection_close(con)
    return actors
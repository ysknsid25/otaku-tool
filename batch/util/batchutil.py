import os

def is_runtime_cloudfunctions():
    runtime_user=os.environ["USER"]
    return runtime_user=="agnotify"

def is_runtime_githubactions():
    runtime_user=os.environ["USER"]
    return runtime_user=="github"

def replace_time_to_str(str_time):
    return str_time.replace(":", "")

def fomat_int_time_to_str(int_time):
    #! A&Gの番組表は午前0時〜は24時~と表記しているため、0の考慮は現状不要
    if int_time == None or int_time<100:
        return ""
    str_time = str(int_time)
    if int_time<1000:
        str_time="0"+str(int_time)
    hour = str_time[0:2]
    minete = str_time[2:4]
    return hour+":"+minete

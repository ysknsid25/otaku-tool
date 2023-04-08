import os

def is_runtime_cloudfunctions():
    runtime_user=os.environ["USER"]
    return runtime_user=="agnotify"

def is_runtime_githubactions():
    runtime_user=os.environ["USER"]
    return runtime_user=="github"

def replace_time_to_str(str_time):
    return str_time.replace(":", "")

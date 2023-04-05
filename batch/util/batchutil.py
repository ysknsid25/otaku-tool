import os

def is_runtime_cloudfunctions():
    runtime_user=os.environ["USER"]
    return runtime_user=="agnotify"

def is_runtime_githubactions():
    runtime_user=os.environ["USER"]
    return runtime_user=="github"
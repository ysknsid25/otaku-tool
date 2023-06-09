# Import the Secret Manager client library.
from google.cloud import secretmanager
import os
from util import batchutil

def get_credential(project_id,secret_id,version_id):
    """
    Access the payload for the given secret version if one exists. The version
    can be a version number as a string (e.g. "5") or an alias (e.g. "latest").
    """
    client = secretmanager.SecretManagerServiceClient()
    name = f"projects/{project_id}/secrets/{secret_id}/versions/{version_id}"
    #print(name)
    response = client.access_secret_version(request={"name": name})
    payload = response.payload.data.decode("UTF-8")
    #print("@@@3")
    #print("Plaintext: {}".format(payload))
    #print(credential)
    #print(type(credential))
    return payload

def get_sendgrid_apikey(project_id_key,secret_id_key,version_id_key):
    """get_sendgrid_apikey
    メール送信を行うためにSendGridのAPIキーを取得する
    """
    key = ""
    if batchutil.is_runtime_cloudfunctions():
        project_id=os.getenv(project_id_key)
        secret_id=os.getenv(secret_id_key)
        version_id=os.getenv(version_id_key)
        return get_credential(project_id,secret_id,version_id)
    if batchutil.is_runtime_githubactions():
        return os.environ["SENDGRID_KEY"]
    return key
from sendgrid import SendGridAPIClient
from sendgrid.helpers.mail import *
from util import secretmanager
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from email.mime.application import MIMEApplication
import os
from util import batchutil

def sendMail(notify_info):
  """notify_info
  メール送信を行う
  """
  if batchutil.is_runtime_cloudfunctions() or batchutil.is_runtime_githubactions():
    apikey=secretmanager.get_sendgrid_apikey('PROJECT_ID','SG_SECRET_ID','SG_VERSION_ID')
    message = Mail()
    message.to=To(notify_info["to"])
    message.from_email = From(notify_info["fr"], notify_info["frnm"])
    message.subject = Subject(notify_info["sub"])
    message.content = Content(MimeType.text, notify_info["text"])
    message.content = Content(MimeType.html, notify_info["html"])
    sendgrid_client = SendGridAPIClient(apikey)
    response = sendgrid_client.send(message)
    #print(response.status_code)
    #print(response.body)
    #print(response.headers)
    return response.status_code
  else:
    smtp_obj = smtplib.SMTP("localhost", "1025")
    body = notify_info["text"]
    msg = MIMEMultipart()
    msg['Subject'] = notify_info["sub"]
    msg['To'] = notify_info["to"]
    msg['From'] = 'localtest@example.com'
    msg.attach(MIMEText(body))
    smtp_obj.send_message(msg)
    smtp_obj.quit()
    return 202
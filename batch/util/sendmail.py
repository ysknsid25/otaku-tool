from sendgrid import SendGridAPIClient
from sendgrid.helpers.mail import *
from util import secretmanager
import os

def sendMail(notify_info):
  """notify_info
  メール送信を行う
  """
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
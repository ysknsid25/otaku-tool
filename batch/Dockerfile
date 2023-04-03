FROM python:3.10-slim

ENV SECRET_KEY=/var/dockerpython/key/adnag-371706-526ff842bdcc.json
ENV USER=pythonuser

RUN pip install --upgrade pip
RUN pip install requests oauth2client gspread google-cloud-secret-manager functions-framework sendgrid

RUN useradd -m pythonuser

WORKDIR /var/dockerpython
COPY requirements.txt /var/dockerpython
COPY main.py /var/dockerpython
COPY key/sendgrid.key /var/dockerpython
RUN chmod -R 755 /var/dockerpython
RUN chown -R pythonuser:pythonuser /var/dockerpython

USER pythonuser
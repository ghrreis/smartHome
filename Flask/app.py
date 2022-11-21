from flask import Flask, request, session
from flask_session import Session
import requests
from datetime import datetime
from Security import Login
from Device import Device
from Log import Logs

app = Flask(__name__)
app.secret_key = "gustavo"
app.config["SESSION_PERMANENT"] = False
app.config["SESSION_TYPE"] = "filesystem"
app.config["SESSION_COOKIE_HTTPONLY"] = True
app.config["SESSION_COOKIE_SAMESITE"] = "Strict"
sess = Session()
sess.init_app(app)


@app.route('/login/<username>/<password>', methods=["POST", "GET"])
def login(username, password):

    auth = Login(username, password)

    if auth.status() == 1:
        session["username"] = username
        session["password"] = password
        time = datetime.now()
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + session["username"] + " logado com sucesso\""
        log = Logs(logging)
        log.saveLog()
        # Retorna msg de login com sucesso, o status da msg ok e o id da sessão
        return '{"msg": "Logado com sucesso!!!", "status": "ok", "session-id": "%s"}' % (session.__dict__["sid"])
    else:
        time = datetime.now()
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + username + " erro no login\""
        log = Logs(logging)
        log.saveLog()
        return '{"msg": "Erro no login!!!"}'


@app.route('/logout', methods=["POSt", "GET"])
def logout():
    session.pop("username")
    session.pop("password")
    session.pop("session-id")

    time = datetime.now()
    logging = request.remote_addr + " - - [" + time.strftime(
        "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
        request.user_agent) + "\" \"Sessão encerrada!!!\""
    log = Logs(logging)
    log.saveLog()

    return '{"msg": "Sessão encerrada!!!"}'


@app.route('/devices')
def devices():
    if session.get("username"):
        dev = Device()
        time = datetime.now()
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + session["username"] + "\""
        log = Logs(logging)
        log.saveLog()
        return dev.listDevices()
    else:
        time = datetime.now()
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" Não logado!!!"
        log = Logs(logging)
        log.saveLog()
        return '{"msg": "Não logado!!!"}'


@app.route('/')
def index():
    return "Página principal"


@app.route('/cmd/<room>/<device>/<status>', methods=['GET', 'POST'])
def cmd(room, device, status):
    if session.get("username"):
        dev = Device()
        result = dev.getDevice(room, device)
        try:
            req = requests.get(result+status)
            if status == "on":
                return '{"msg": "Ligado"}'
            else:
                return '{"msg": "Desligado"}'
        except Exception as e:
                return '{"msg": "Erro de comunicação"}'
        time = datetime.now()
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + session["username"] + "\""
        log = Logs(logging)
        log.saveLog()

    time = datetime.now()
    logging = request.remote_addr + " - - [" + time.strftime(
        "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
        request.user_agent) + "\" \"Não logado!!!\""
    log = Logs(logging)
    log.saveLog()
    return '{"msg": "Não logado!!!"}'

@app.errorhandler(404)
def page_not_found(e):
    return "pagina nao encontrada"


@app.route('/info')
def info():
    user_agent = request.headers.get('User-Agent')
    return "ok"


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5005, debug=False)

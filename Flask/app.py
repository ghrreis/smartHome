'''
    Aplicação principal para executar o Flask e suas rotas do sistema smartHome
'''

from flask import Flask, request, session
from flask_session import Session
from datetime import datetime
from Security import Login
from Device import Device
from Log import Logs
import requests

app = Flask(__name__)
app.secret_key = "gustavo"
app.config["SESSION_PERMANENT"] = False
app.config["SESSION_TYPE"] = "filesystem"
app.config["SESSION_COOKIE_HTTPONLY"] = True
app.config["SESSION_COOKIE_SAMESITE"] = "Strict"
sess = Session()
sess.init_app(app)


'''
    Rota para logar na aplicação
    Ex. http://localhost:5005/login/usuario/senha
'''
@app.route('/login/<username>/<password>', methods=["POST", "GET"])
def login(username, password):

    # Classe Login responsável por autenticar o usuário
    auth = Login(username, password)

    # Se autenticação com sucesso cria as variáveis de sessão username e password
    if auth.status() == 1:
        session["username"] = username
        session["password"] = password
        time = datetime.now()  # Acessa a data e hora do SO
        # Gera string do log de login do usuário
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + session["username"] + " logado com sucesso\""
        log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
        log.saveLog()  # Salva o histórico de acesso
        # Retorna msg de login com sucesso, o status da msg ok e o id da sessão
        return '{"msg": "Logado com sucesso!!!", "status": "ok", "session-id": "%s"}' % (session.__dict__["sid"])
    else:  # Caso contrário retorna para o sistema msg de falha de login
        time = datetime.now()  # Acessa a data e hora do SO
        # Gera string do log de falha de login do usuário
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + username + " erro no login\""
        log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
        log.saveLog()  # Salva o histórico de acesso
        return '{"msg": "Erro no login!!!", "status": "nok"}'

'''
    Rota para efetuar logoff na aplicação
    Ex. http://localhost:5005/logout
'''
@app.route('/logout', methods=["POSt", "GET"])
def logout():
    # Apaga as variáveis de sessão username e password
    session.pop("username")
    session.pop("password")

    time = datetime.now()  # Acessa a data e hora do SO
    # Gera string do log de logout do usuário
    logging = request.remote_addr + " - - [" + time.strftime(
        "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
        request.user_agent) + "\" \"Sessão encerrada!!!\""
    log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
    log.saveLog()  # Salva o histórico de acesso

    return '{"msg": "Sessão encerrada!!!", "status": "ok"}'

'''
    Rota para exibir os dispositivos de um determinado cômodo da casa
    Ex. http://localhost:5005/devices/quarto-1
'''
@app.route('/devices/<room>', methods=["POSt", "GET"])
def devices(room):
    if session.get("username"):  # Verifica se a sessão existe (usuário logado)
        dev = Device()  # Classe Device responsável por manipular os dispositivos
        time = datetime.now()  # Acessa a data e hora do SO
        '''
            Gera string do log de acesso aos dispositivos de um determinado cômodo
            Ex. http://localhost:5005/devices/Quarto-2
        '''
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + session["username"] + "\""
        log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
        log.saveLog()  # Salva o histórico de acesso
        # Retorna o status da msg ok, o id da sessão e lista dos dispositivos de um determinado cômodo
        return '{"status": "ok", "session-id": "%s", "items": %s}' % (session.__dict__["sid"], dev.listDevices(room))
    else:  # Caso o usuário não esteja logado
        time = datetime.now()  # Acessa a data e hora do SO
        # Gera string do log de usuário não logado
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" Não logado!!!"
        log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
        log.saveLog()  # Salva o histórico de acesso
        return '{"msg": "Não logado!!!", "status": "nok"}'

'''
    Rota para exibir os cômodos da casa
    Ex. http://localhost:5005/rooms
'''
@app.route('/rooms')
def rooms():
    if session.get("username"):  # Verifica se a sessão existe (usuário logado)
        dev = Device()  # Classe Device responsável por manipular os dispositivos
        time = datetime.now()  # Acessa a data e hora do SO
        '''
            Gera string do log de acesso aos cômodos da casa
            Ex. http://localhost:5005/rooms
        '''
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"" + session["username"] + "\""
        log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
        log.saveLog()  # Salva o histórico de acesso
        # Retorna msg de login com sucesso, o status da msg ok e o id da sessão
        return '{"status": "ok", "session-id": "%s", "rooms": %s}' % (session.__dict__["sid"], dev.listRooms())
    else:  # Caso o usuário não esteja logado
        time = datetime.now()  # Acessa a data e hora do SO
        # Gera string do log de usuário não logado
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" Não logado!!!"
        log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
        log.saveLog()  # Salva o histórico de acesso
        return '{"msg": "Não logado!!!", "status": "nok"}'


@app.route('/')
def index():
    return "Página principal"

'''
    Rota para executar uma ação (liga/desliga) a um dispositivo de um determinado cômodo da casa
    Ex. http://localhost:5005/quarto-1/luz/on
'''
@app.route('/cmd/<room>/<device>/<status>', methods=['GET', 'POST'])
def cmd(room, device, status):
    if session.get("username"):  # Verifica se a sessão existe (usuário logado)
        dev = Device()  # Classe Device responsável por manipular os dispositivos
        result = dev.getDevice(room, device)  # Método responsável por retornar o URL e o relay do dispositivo
        try:
            #req = requests.get(result+status)  # Executa a ação (liga/desliga) no dispositivo

            time = datetime.now()  # Acessa a data e hora do SO
            '''
                Gera string do log de ação ao dispositivo de um determinado cômodo da casa
                Ex. /cmd/Quarto-1/Ventilador/on
            '''
            logging = request.remote_addr + " - - [" + time.strftime(
                "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
                request.user_agent) + "\" \"" + session["username"] + "\""
            log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
            log.saveLog()  # Salva o histórico de acesso

            # Retorna msg da ação executada (ligada/desligada)
            if status == "on":
                return '{"status": "ok", "device": "%s", "msg": "(Ligado)"}' % (device)
            else:
                return '{"status": "ok", "device": "%s", "msg": "(Desligado)"}' % (device)
        except Exception as e:  # Retorna erro de comunicação caso haja alguma exceção
                return '{"status": "nok", "msg": "Erro de comunicação"}'
    else:  # Caso o usuário não esteja logado
        time = datetime.now()  # Acessa a data e hora do SO
        # Gera string do log de usuário não logado
        logging = request.remote_addr + " - - [" + time.strftime(
            "%d/%b/%Y:%H:%M:%S") + "] \"" + request.method + " " + request.url + "\" \"" + str(
            request.user_agent) + "\" \"Não logado!!!\""
        log = Logs(logging)  # Classe Logs responsável por guardar o histórico de acesso
        log.saveLog()  # Salva o histórico de acesso
        return '{"status": "ok", "msg": "Não logado!!!"}'

@app.errorhandler(404)
def page_not_found(e):
    return "Page not found"


@app.route('/info')
def info():
    user_agent = request.headers.get('User-Agent')
    return "ok"


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5005, debug=False)

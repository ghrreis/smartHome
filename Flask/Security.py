# Classe para verificação de autenticação e níveis de acesso

import json


class Login():

    __user = ""
    __password = ""
    __status = 0

    # Construtor que recebe username/password como parâmetro
    def __init__(self, username, password):
        self.__user = username
        self.__password = password
        self.__status = 0
        f = open("login.json", "r") # Abre arquivo de senhas (padrão JSON)
        file = f.read()
        # Desserializa o JSON em um objeto Python. Transforma em um array de dictionary
        users = json.loads(file)
        for login in users: # Navega em cada usuário do arquivo e compara com o usuário/senha informado
            # Se usuário existe valida autenticação
            if (self.__user == login["username"]) and (self.__password == login["password"]):
                self.__status = 1
                break

    # Método que retorna o status do login (1-login OK, 0-login NOK)
    def status(self):
        return self.__status
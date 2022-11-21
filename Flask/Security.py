# Classe para verificação de autenticação e níveis de acesso

import json


class Login():

    __user = ""
    __password = ""
    __status = 0

    def __init__(self, username, password):
        self.__user = username
        self.__password = password
        self.__status = 0
        f = open("login.json", "r")
        file = f.read()
        users = json.loads(file)
        for login in users:
            if (self.__user == login["username"]) and (self.__password == login["password"]):
                self.__status = 1
                break

    def status(self):
        return self.__status
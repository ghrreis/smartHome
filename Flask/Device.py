# Classe para manipular os dispositivos

import json


class Device():

    __listDevices = ""
    __listRooms = []

    def __init__(self):
        return None

    # Retorna uma lista de todos os ambientes com seus dispositivos
    def listDevices(self, room):
        f = open("devices.json", "r")
        file = f.read()
        # Desserializa o JSON em um objeto Python. Transforma em um array de dictionary
        devices = json.loads(file)
        for device in devices:  # Navega em cada room
            if device["room"] == room:
                self.__listDevices = device["items"]
        return self.__listDevices

    # Retorna uma lista dos ambientes
    def listRooms(self):
        self.__listRooms.clear()
        f = open("devices.json", "r")
        file = f.read()
        # Desserializa o JSON em um objeto Python. Transforma em um array de dictionary
        rooms = json.loads(file)
        for room in rooms:  # Navega em cada room
            # Desserializa o JSON em um objeto Python retirando a chave url. Transforma em uma dictionary
            item = json.loads('{"room":"%s"}' % (room["room"]))
            # Insere cada dictionary em um array
            self.__listRooms.append(item)
        return self.__listRooms

    # Retorna o URL do dispositivo que será manipulado
    def getDevice(self, room, dev):
        sw = ""
        url = ""
        f = open("devices.json", "r")
        file = f.read()
        # Desserializa o JSON em um objeto Python. Transforma em um array de dictionary
        devices = json.loads(file)
        for device in devices:  # Navega em cada room
            item = json.loads(str(device).replace("\'", "\""))
            if item["room"] == room:  # Caso o room seja igual ao escolhido
                url = item["url"]  # Recupera o URL
                # Cria um vetor com os items do room (Ex. luz e ventilador)
                vetItems = json.loads(str(item["items"]).replace("\'", "\""))
                for i in vetItems:  # Navega item a item
                    # Caso o item seja igual ao selecionado (Ex. ventilador)
                    if i["device"] == dev:
                        sw = i["switch"]  # Retorna o relay associado (Ex. relay2)
                        break
        # Retorna o endereço montado (Ex. http://192.168.0.102/?relay2=)
        return url + "/?" + sw + "="
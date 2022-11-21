# Classe para manipular os dispositivos

import json


class Device():

    __listDevices = []

    def __init__(self):
        return None


    def listDevices(self):
        self.__listDevices.clear()
        f = open("devices.json", "r")
        file = f.read()
        # Desserializa o JSON em um objeto Python. Transforma em um array de dictionary
        devices = json.loads(file)
        for device in devices:  # Navega em cada room
            # Desserializa o JSON em um objeto Python retirando a chave url. Transforma em uma dictionary
            item = json.loads('{"room":"%s", "items":"%s"}' % (device["room"], device["items"]))
            # Insere cada dictionary em um array
            self.__listDevices.append(item)
        return self.__listDevices


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
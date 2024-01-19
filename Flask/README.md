## smartHome
### Instalação das bibliotecas
pip install flask

pip install flask_session

### Gerando o certificado SSL
openssl req -x509 -newkey rsa:4096 -nodes -out cert.pem -keyout key.pem -days 365

### Execução da aplicação
python app.py
<?php

    class Requests {

        private $page; // Atributo que armazena a URL
        private $cookie; // Atributo que armazena a sessão criada com o Flask
        private $ch; // Atributo que armazena a requisição feita com o Flask
        private $response; // Atributo que armazena o resultado da requisição feita ao Flask

        /* 
            Construtor que recebe como parâmetro a URL e configura a sessão cURL
            para ser requisitada ao Flask
        */
        function __construct($page) {
            $this->page = $page;
            $this->ch = curl_init(); // Inicia a sessão cURL
            curl_setopt($this->ch, CURLOPT_URL, $this->page); // Configura a sessão cURL para requisitar a página
            // Configura a sessão cURL para receber o retorno em forma de string
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            // Configura a sessão cURL para ser redirecionado caso seja necessário
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
	    // Desabilita a verificação do certificado SSL do host
	    curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
	    // Desabilita a verificação do certificado SSL do peer
	    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0); 
	}

        // Método responsável por fazer a requisição ao Flask
        function get() {            
            $this->response = curl_exec($this->ch); // Executa a requisição
            curl_close($this->ch); // Fecha a conexão com o Flask
            return $this->response; // Retorna o resultado da requisição feita ao Flask
        }

        /* 
            Configura a sessão cURL com o valor da sessão do Flask
            Desta forma garante que continue "logado" no Flask
        */
        function setSession($cookie) {
            $this->cookie = $cookie;
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array($this->cookie));
        }
    }

?>

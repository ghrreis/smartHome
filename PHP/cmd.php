<?php
    include('requests.php');
    // Verifica se o usuário está "logado" através da variável de sessão STATUS
    if ($_SESSION['status'] == 1) {
        /*
            Monta o endereço para ser requisitado ao servidor Flask
            Ex.: https://localhost:5005/cmd/quarto-1/luz/on
        */
        $page = "https://localhost:5005/cmd/".$_REQUEST['room']."/".$_REQUEST['item']."/".$_REQUEST['status'];
        
        $req = new Requests($page); // Instancia a classe Requests passando a URL como parâmetro
        // Atribui o valor da sessão do Flask na variável COOKIE
        $cookie = "Cookie: session = ".$_SESSION['session'];
        $req->setSession($cookie); // Configura a sessão
        $response = $req->get(); // Faz a requisição ao Flask e retorna o resultado

        // Troca o caracter ' para "" vinda da resposta do Flask
        $response = str_replace('\'', '"', $response); 
        $responseObj = json_decode($response); // Recebe a resposta do Flask no formato JSON
        
        if ($responseObj->{'status'} == "ok") // Verifica se a resposta é um "OK"
            echo "<b>".$_REQUEST['room']."</b><br><br>"; // Imprime o cômodo
            // Imprime a ação (ligado/desligado) do item (ventilador, luz, cafeteira)
            echo $responseObj->{'device'}."&nbsp;".$responseObj->{'msg'}."<br><br>";
            // Redireciona para a página que exibe o cômodo
            echo '<meta http-equiv="refresh" content="2;index.php?arquivo=devices.php&room='.$_REQUEST['room'].
            '" />';
    } else { // Caso contrário o usuário não está "logado"
        echo "Não logado";
        echo '<meta http-equiv="refresh" content="2;index.php" />';
    }

?>

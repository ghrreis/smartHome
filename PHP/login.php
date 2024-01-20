<?php
    include('requests.php');
    /*
        Monta o endereço para ser requisitado ao servidor Flask
        Ex.: http://localhost:5005/login/jose/123456
    */
    $page = "https://localhost:5005/login/".$_POST["username"]."/".$_POST["password"];

    $req = new Requests($page); // Instancia a classe Requests passando a URL como parâmetro
    $response = $req->get(); // Faz a requisição ao Flask e retorna o resultado

    $responseObj = json_decode($response); // Recebe a resposta do Flask no formato JSON
    
    // Verifica se a resposta é um "OK"
    if ($responseObj->{'status'} == "ok")
        $_SESSION['status'] = 1; // Cria sessão de login com status igual a 1
        /* 
            Guarda na sessão do PHP a sessão criada no Flask
            Desta forma é possível controlar a sessão do Flask de forma remota
        */
        $_SESSION['session'] = $responseObj->{'session-id'};
        echo "<b>".$responseObj->{'msg'}."</b><br><br>"; // Exibe mensage de "Logado com sucesso"
        // Redireciona para a página principal, passando como parâmetro o arquivo rooms.php
        echo '<meta http-equiv="refresh" content="2;index.php?arquivo=rooms.php" />';

?>

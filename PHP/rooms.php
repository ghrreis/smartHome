<?php
    include('requests.php');
    // Verifica se o usuário está "logado" através da variável de sessão STATUS
    if ($_SESSION['status'] == 1) {
        $page = "https://localhost:5005/rooms"; // Monta o endereço para ser requisitado ao servidor Flask
        
        $req = new Requests($page); // Instancia a classe Requests passando a URL como parâmetro
        // Atribui o valor da sessão do Flask na variável COOKIE
        $cookie = "Cookie: session = ".$_SESSION['session'];
        $req->setSession($cookie);
        $response = $req->get();

        // Troca o caracter ' para "" vinda da resposta do Flask
        $response = str_replace('\'', '"', $response);
        $responseObj = json_decode($response); // Recebe a resposta do Flask no formato JSON

        if ($responseObj->{'status'} == "ok") // Verifica se a resposta é um "OK"
            echo "<label for='rooms'>Escolha o cômodo:</label><br>
                <form action='index.php' method='post'>
                 <select name='room' id='room'>
                ";
            // Faz uma iteração para criar um combobox com os cômodos da casa
            foreach ($responseObj->{'rooms'} as $room)
                echo "<option value='".$room->{'room'}."'>".$room->{'room'}."</option>";
            echo "</select>
                <input type='hidden' name='arquivo' value='devices.php'><br><br>
                <input type='submit' name='submitOK' value='OK'><br><br>";
    } else { // Caso contrário o usuário não está "logado"
        echo "Não logado";
        echo '<meta http-equiv="refresh" content="2;index.php" />';
    }

?>

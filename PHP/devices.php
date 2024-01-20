<?php
    include('requests.php');
    // Verifica se o usuário está "logado" através da variável de sessão STATUS
    if ($_SESSION['status'] == 1) {
        /*
            Monta o endereço para ser requisitado ao servidor Flask
            Ex.: https://localhost:5005/quarto-1
        */
        $page = "https://localhost:5005/devices/".$_REQUEST['room'];
        
        $req = new Requests($page); // Instancia a classe Requests passando a URL como parâmetro
        // Atribui o valor da sessão do Flask na variável COOKIE
        $cookie = "Cookie: session = ".$_SESSION['session'];
        $req->setSession($cookie); // Configura a sessão
        $response = $req->get(); // Faz a requisição ao Flask e retorna o resultado

        // Troca o caracter ' para "" vinda da resposta do Flask
        $response = str_replace('\'', '"', $response); 
        $responseObj = json_decode($response); // Recebe a resposta do Flask no formato JSON
        
        if ($responseObj->{'status'} == "ok") // Verifica se a resposta é um "OK"
            echo "<b>".$_REQUEST['room']."</b><br><br>";
            echo "<label for='rooms'>Escolha o dispositivo:</label><br>
                <form action='index.php' method='post'>
                 <select name='item' id='item'>
                ";
            // Faz uma iteração para criar um combobox com os itens do cômodo (Ex. luz, ventilador)
            foreach ($responseObj->{'items'} as $item)
                echo "<option value='".$item->{'device'}."'>".$item->{'device'}."</option>";
            echo "</select>
                <input type='hidden' name='room' value='".$_REQUEST['room']."'>
                <input type='hidden' name='arquivo' value='cmd.php'><br><br>
                <input type='radio' name='status' value='on'><label for='status'>&nbsp;Ligar</label><br>
                <input type='radio' name='status' value='off'><label for='status'>&nbsp;Desligar</label><br>
                <input type='submit' name='buttonOK' value='OK'><br><br>";
    } else { // Caso contrário o usuário não está "logado"
        echo "Não logado";
        echo '<meta http-equiv="refresh" content="2;index.php" />';
    }

?>

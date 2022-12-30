<?php

    echo "
        <h3>SmartH</h3>
        <!--<a href='#'>Call: +01-099-908-908</a>-->
        <a href='#main-sec'><i class='fa fa-home fa-3x'></i>HOME</a>
        <a href='#about-sec'><i class='fa fa-microphone fa-3x'></i>SOBRE</a>
    ";

    /* 
        Se usuário "logado" exibe links específicos.
        Caso contrário, exibe links gerais
    */
    if ($_SESSION['status'] == 1) {
        echo "<a href='index.php?arquivo=logout.php'><i class='fa fa-sign-out fa-3x'></i>SAIR</a>";
        echo "<a href='index.php?arquivo=rooms.php'><i class='fa fa-home fa-3x'></i>CÔMODOS</a>";
    } else {
        echo "<a href='#content-sec'><i class='fa fa-sign-in fa-3x'></i>ENTRAR</a>";
    }

    echo "    
        <a href='#partners'><i class='fa fa-rocket fa-3x'></i>PARCEIROS</a>
        <a href='#contact-sec'><i class='fa fa-globe fa-3x'></i>CONTATO</a>
    ";
    
?>
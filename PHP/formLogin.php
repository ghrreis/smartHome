<?php
    // Formulário de login
    echo "
        <form action='index.php' method='post'>
            <label for='username'>Usuário:</label><br>
            <input type='text' name='username'><br><br>
            <label for='password'>Senha:</label><br>
            <input type='password' name='password'><br><br>
            <input type='hidden' name='arquivo' value='login.php'>
            <input type='submit' name='login' value='Logar'>
        </form><br>
    ";
?>
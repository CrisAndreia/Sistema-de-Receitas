<html>

<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<link href="style.css" rel="stylesheet" type="text/css" />
<header>
</header>
    <body>
        <section>
        <div>
        <?php
        $usuario = $senha = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "POST";
            $usuario = test_input($_POST["usuario"]);
            $senha = test_input($_POST["senha"]);

            $link = mysqli_connect("localhost", "root", "", "provaODAW");
            $query = "SELECT * FROM usuarios";
            $result = mysqli_query($link, $query);
            if ($row = mysqli_fetch_row($result)) {
                $usuarioBD = $row[0];
                $senhaBD = $row[1];
            }

            if ($usuario == $usuarioBD && $senha == $senhaBD) {
                echo 'Login efetuado com sucesso';
                header('Location: painel.php');
            }
            else {
                echo 'Usuario ou senha são inválidos! Tente novamente!';
                header('Location: login.php');
            }

        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p><span class="error">* Campo obrigatório</span></p>
            <p>
                Usuario: <input type="text" name="usuario" id="usuario">
                <span class="error">*</span>
            </p>
            <p>Senha: <input type="password" name="senha" id="senha">
                <span class="error">*</span>
            </p>
            <p>
            <input type="submit" value="Entrar">
            <p>
        </form>
        </div>
    </sction>
    </body>
    <footer>
      <p>&copy; CristianeAndreiaPereira</p>
    </footer>

</html>


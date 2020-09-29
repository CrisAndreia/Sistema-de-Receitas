<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Formulario</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <header>
      <h1>Php + MySql</h1>
    </header>
    <section>
    <div>
    <body>

    <?php




        $erroReceita = $erroAutor = $erroTipo = $erroIngredientes = $erroEvento = "";
        $receita = $autor = $tipo = $ingredientes = $evento = "";


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["receita"])) {
                $erroReceita = getRequiredErrorMessage("Receita");
            } else {
                $receita = test_input($_POST["receita"]);
                if (!preg_match("/^[a-zA-Z ]*$/", $receita)) {
                    $erroReceita = "Apenas letras e espaços são permitidos";
                }
            }

            if (empty($_POST["autor"])) {
                $erroAutor = getRequiredErrorMessage("Autor");
            } else {
                $autor = test_input($_POST["receita"]);
                if (!preg_match("/^[a-zA-Z ]*$/", $autor)) {
                    $erroAutor = "Apenas letras e espaços são permitidos";
                }
            }

            if (empty($_POST["tipo"])) {
                $erroTipo = getRequiredErrorMessage("Tipo");
            } else {
                $tipo = test_input($_POST["tipo"]);
            }

            if (empty($_POST["ingredientes"])) {
                $erroIngredientes = getRequiredErrorMessage("Ingredientes");
            } else {
                $ingredientes = test_input($_POST["ingredientes"]);
            }

            if (empty($_POST["evento"])) {
                $erroEvento = getRequiredErrorMessage("Evento");
            } else {
                $evento = test_input($_POST["evento"]);
            }

            if (canSave($erroReceita, $erroAutor, $erroTipo, $erroIngredientes, $erroEvento)) {
                save($receita, $autor, $tipo, $ingredientes, $evento);
            }
        }


        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function getRequiredErrorMessage($fieldReceita)
        {
            return $fieldReceita . " é obrigatório";
        }

        function canSave($erroReceita, $erroAutor, $erroTipo, $erroIngredientes, $erroEvento)
        {
            return (empty($erroReceita) && empty($erroAutor) && empty($$erroTipo) && empty($erroIngredientes) && empty($erroEvento));
        }

        function save($receita, $autor, $tipo, $ingredientes, $evento)
        {
            $link = mysqli_connect("localhost", "root", "", "provaODAW");
            $query = "INSERT INTO receitas (receita, autor, tipo, ingredientes, evento) VALUES ('$receita', '$autor', '$tipo', '$ingredientes', '$evento')";
            echo "INSERT: $query<br><hr>";
            mysqli_query($link, $query);
            mysqli_close($link);
        }

        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <p><span class="error">* Campo obrigatório</span></p>
            <p>
                Receita: <input type="text" name="receita" id="receita">
                <span class="error">* <?php echo $erroReceita; ?></span>
            </p>
            <p>Autor: <input type="text" name="autor" id="autor">
                <span class="error">* <?php echo $erroAutor; ?></span>
            </p>
            <p>
                Tipo:
                <input type="radio" name="tipo" value="doce">Doce
                <input type="radio" name="tipo" value="salgado">Salgado
                <span class="error">* <?php echo $erroTipo; ?></span>
            </p>
            <p>
                Ingredientes: <textarea name="ingredientes" id="ingredientes" cols="30" rows="5"></textarea></p>
                <span class="error">* <?php echo $erroIngredientes; ?></span>
            </p>
            <p>
                Evento:<select name="evento" id="evento">
                <option value="" disable selected hidden>Selecione o evento adequado...</option>
                <option value="Aniversário">Aniversário</option>
                <option value="Final de Semana">Final de Semana</option>
                <option value="Amigo Secreto">Amigo Secreto</option>
                <option value="Encerramentos">Encerramentos</option>
            </select>
            <span class="error">* <?php echo $erroEvento; ?></span>
        </p>


            <input type="submit" value="Submit">
            <input type="reset" value="Limpar campos">
        </form>

        <?php
        echo "<h2>Seus Dados:</h2>";
        echo "Receita: " . $receita;
        echo "<br>";
        echo "Autor: " . $autor;
        echo "<br>";
        echo "Tipo: " . $tipo;
        echo "<br>";
        echo "Ingredientes: " . $ingredientes;
        echo "<br>";
        echo "Eventos: " . $evento;
        echo "<br>";
        ?>

        <br>
        <br>
        <br>


        <form action="listAction.php" method="POST">
            <fieldset>
                <legend>Listar cadastros</legend>
                <input type="submit" value="Listar">
            </fieldset>
        </form>

    </body>
      </div>
      <div>
      </div>
    </section>
    <footer>
      <p>&copy; CristianeAndreiaPereira</p>
    </footer>
  </body>
</html>


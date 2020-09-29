<html>
<link href="style.css" rel="stylesheet" type="text/css" />
<body>

    <?php
    include("painel.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $link = mysqli_connect("localhost", "root", "", "provaODAW");
            
        $query = "SELECT * FROM receitas ORDER BY id_receita";
        $result = mysqli_query($link, $query);
        
        echo "SELECT: $query<br>";
        echo "<table border=\"1\", align=center>";
        echo "<tr><td><b>Id</b></td>";
        echo "<td><b>Receita</b></td>";
        echo "<td><b>Autor</b></td>";
        echo "<td><b>Tipo</b></td>";
        echo "<td><b>Ingredientes</b></td>";
        echo "<td><b>Eventos</b></td>";
      
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr><td>".$row[0]."</td>";
            echo "<td>".$row[1]."</td>";
            echo "<td>".$row[2]."</td>";
            echo "<td>".$row[3]."</td>";
            echo "<td>".$row[4]."</td>";
            echo "<td>".$row[5]."</td>";
        }
        echo "</table><hr>";
        
        mysqli_close($link);
        
    }


    ?>
</body>


</html>
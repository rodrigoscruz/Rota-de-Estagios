<?php

include('conexao.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Busca</title>
</head>
<body>
    <h1>Pesquisa de estagiário</h1>
    <form action="">
        Sexo: 
        <input type="radio" value="m" name="sexo"/>Masc.
        <input type="radio" value="f" name="sexo"/>Fem. <br/>
        <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Pesquise uma habilidade" type="text">
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table width="600px" border="1">
        <tr>
            <th>Nome</th>
            <th>Sexo</th>
            <th>Habilidade</th>
            <th>Nível</th>
        </tr>
        <?php
        if (!isset($_GET['busca'])){
            if (!isset($_GET['sexo'])){
            ?>
        <tr>
            <td colspan="4">Digite algo para pesquisar...</td>
        </tr>
        <?php
            }
        } else {
            $pesquisa = $mysqli->real_escape_string($_GET['busca']);
            if(empty($_GET['sexo'])){
                $sql_code = "SELECT * FROM estagiarios WHERE habilidade LIKE '%$pesquisa%'
                ORDER BY nivel";
            }else{
                $pesquisasex = $mysqli->real_escape_string($_GET['sexo']);
                $sql_code = "SELECT * FROM estagiarios WHERE habilidade LIKE '%$pesquisa%'
                AND sexo LIKE '%$pesquisasex%' ORDER BY nivel";
            }
            
            $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
            
            if ($sql_query->num_rows == 0) {
                ?>
            <tr>
                <td colspan="4">Nenhum resultado encontrado...</td>
            </tr>
            <?php
            } else {
                while($dados = $sql_query->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['sexo']; ?></td>
                        <td><?php echo $dados['habilidade']; ?></td>
                        <td><?php echo $dados['nivel']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        <?php
        } ?>
    </table>
</body>
</html>
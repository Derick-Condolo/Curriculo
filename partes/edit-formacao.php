<?php 
require_once 'crud.php';
$id_formacao = $_GET['id'];
$uid = readOne($pdo, 'dados','id');
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $formacao = [
        'uid' => $uid,
        'unidade_ensino' => $_POST['unidade_ensino'],
        'grau_escolaridade' => $_POST['grau_escolaridade'],
        'situacao' => $_POST['situacao'],
        'tipo_curso' => $_POST['tipo_curso'],
        'data_entrada' => $_POST['data_entrada'],
        'data_conclusao' => $_POST['data_conclusao']
    ];
    $linhasAfetadas = update($pdo, 'formacao', $formacao, "id='" . $id_formacao . "'");
    if($linhasAfetadas != null){
        header("Location: editar.php");
        exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <title>Editar Formação</title>
</head>
<body>
    <div class="form-box">
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend><b>Editar Formação</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="unidade_ensino" id="unidade_ensino" class="inputuser">
                    <label for="unidade_ensino" class="labelInput">Unidade de Ensino</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="grau_escolaridade" id="grau_escolaridade" class="inputuser">
                    <label for="grau_escolaridade" class="labelInput">Grau de Escolaridade</label>
                </div>
                <p class="microtext">Situação:</p>
                    <input type="radio" id="situacao" name="situacao" value="Cursando">
                    <label for="situacao">Cursando</label>
                    <br>
                    <input type="radio" id="situacao" name="situacao" value="Concluído">
                    <label for="situacao">Concluído</label>
                <br><br><br>
                <div class="inputBox">
                    <input type="text" name="tipo_curso" id="tipo_curso" class="inputuser">
                    <label for="tipo_curso" class="labelInput">Tipo do Curso (Opcional)</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="data_entrada" id="data_entrada" class="inputuser">
                    <label for="data_entrada" class="labelInput">Data de Entrada</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="data_conclusao" id="data_conclusao" class="inputuser">
                    <label for="data_conclusao" class="labelInput">Data de Conclusão</label>
                </div>
                <br><br><br>
                <div class="buttons">
                    <button type="submit" name="submit" id="submit" class="button edit-profile">Salvar alterações</button>  
                    <a href="../editar.php?id=<?php $id ?>" class="edit-profile"><button class="button">Voltar</button></a>
                </div>
                <br>
            </fieldset>
        </form>
    </div>
</body>
</html>
<?php 
require_once 'partes/crud.php';
$id = readOne($pdo, 'dados','id');
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $experiencias = [
        'uid' => $id,
        'empresa' => $_POST['empresa'],
        'cargo_empresa' => $_POST['cargo_empresa'],
        'data_admissao' => $_POST['data_admissao'],
        'data_demissao' => $_POST['data_demissao'],
    ];
    $linhasAfetadas = update($pdo, 'experiencias', $experiencias, "id='" . $id_experiencia . "'");
    if($linhasAfetadas != null){
        header("Location: editar.php");
        exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Formação</title>
</head>
<body>
    <div class="edit-box">
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend><b>Editar Formação</b></legend>
                <br>
                <h3>Formações (Opcional)</h3>
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
                <br><br>
                <div class="inputBox">
                    <input type="text" name="situacao" id="situacao" class="inputuser">
                    <label for="situacao" class="labelInput">Situação</label>
                </div>
                <br><br>
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
                <br>
            </fieldset>
        </form>
    </div>
</body>
</html>
<?php 
require_once 'crud.php';
$id = readOne($pdo, 'dados','id');
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $novaExperiencia = [
        'uid' => $id,
        'empresa' => $_POST['empresa'],
        'cargo_empresa' => $_POST['cargo_empresa'],
        'data_admissao' => $_POST['data_admissao'],
        'data_demissao' => $_POST['data_demissao'],
    ];
    $id_experiencia = create($pdo, 'experiencias', $novaExperiencia);
    if ($id_experiencia != NULL){
        header("Location: ../editar.php");
    }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <title>Adicionar Experiência</title>
</head>
<body>
    <header>
        <h1>Currículo</h1>
    </header>
    <div class="exp-box">
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend><b>Adicionar Experiência</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="empresa" id="empresa" class="inputuser">
                    <label for="empresa" class="labelInput">Empresa</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cargo_empresa" id="cargo_empresa" class="inputuser">
                    <label for="cargo_empresa" class="labelInput">Cargo na Empresa</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="date" name="data_admissao" id="data_admissao" class="inputuser">
                    <label for="data_admissao" class="labelInput">Data de Admissão</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="date" name="data_demissao" id="data_demissao" class="inputuser">
                    <label for="data_demissao" class="labelInput">Data de Demissão (Se tiver)</label>
                </div>
                <br><br><br>
                <div class="buttons">
                    <button type="submit" name="submit" id="submit" class="button edit-profile">Salvar alterações</button>  
                    <a href="../editar.php?id=<?php $id ?>" class="edit-profile"><button class="button">Voltar</button></a>
                </div>
                <br>
            </fieldset>
        </form>
    </body>
</html>
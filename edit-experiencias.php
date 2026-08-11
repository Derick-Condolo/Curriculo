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
    <div class="edit-box">
        <form action="" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend><b>Editar informações</b></legend>
                <br>
                <h3>Experiências (Opcional)</h3>
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
                    <a href="editar.php?id=<?php $id ?>" class="edit-profile"><button class="button">Voltar</button></a>
                </div>
                <br>
            </fieldset>
        </form>
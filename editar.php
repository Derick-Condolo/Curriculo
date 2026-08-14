<?php 
require_once 'partes/crud.php';
$id = readOne($pdo, 'dados','id');
$experiencias = readAll($pdo,'experiencias','uid = '. $id);
$formacoes = readAll($pdo,'formacao','uid = '. $id);
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $dados = [
        'nome' => $_POST['nome'],
        'nome_apr' => $_POST['nome_apr'],
        'descricao' => $_POST['descricao'],
        'data_nasc' => $_POST['data_nasc'],
        'idade' => $_POST['idade'],
        'cargo' => $_POST['cargo'],
        'foto' => ""
    ];
    $contatos = [
        'uid' => $id,
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'endereco' => $_POST['endereco'],
    ];
    // Atualiza os dados (sem Foto) primeiro
    $linhasAfetadas = update($pdo, 'dados', $dados, "id='" . $id . "'");

    // Processar upload somente se um arquivo foi enviado sem erros
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $tipo_permitido = ['image/jpeg','image/png','image/gif','image/jpg'];
        if(!in_array($_FILES['arquivo']['type'], $tipo_permitido)) {
            echo "Tipo de arquivo não permitido.";
            exit;
        }

        $tamanho_max = 5 * 1024 * 1024; // 5MB
        if($_FILES['arquivo']['size'] > $tamanho_max) {
            echo "Arquivo muito grande.";
            exit;
        }

        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        $novonome = "capa_" . uniqid() . "." . $extensao;

        // Caminho físico onde o arquivo será salvo (a partir deste arquivo em MySQL/)
        $dirFisico = __DIR__ . '../uploads/';
        $caminhoFisico = $dirFisico . $id . '/';
        if(!is_dir($caminhoFisico)) {
            mkdir($caminhoFisico, 0755, true);
        }

        $filePath = $caminhoFisico . $novonome;
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $filePath)){
            // Caminho relativo usado nas páginas web
            $capaUrl = 'uploads/' . $id . '/' . $novonome;
            update($pdo, 'dados', ['foto' => $capaUrl], "id = " . $id);
            echo "Imagem enviada com sucesso.";
        } else {
            echo "Erro ao enviar imagem.";
        }
        };
    $linhasAfetadas2 = update($pdo, 'contatos', $contatos, "uid = '" . $id . "'" );

    if($linhasAfetadas != null || $linhasAfetadas2 != null){
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
    <link rel="stylesheet"  href="partes/style.css">
    <title>Editar Currículo</title>
</head>
<body>
    <header>
        <h1>Currículo</h1>
    </header>
    <section class="teste">
        <div class="edit-box">
            <form action="" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend><b>Editar informações</b></legend>
                    <br>
                    <h3>Dados Pessoais</h3>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputuser">
                        <label for="nome" class="labelInput">Nome Completo</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="nome_apr" id="nome_apr" class="inputuser">
                        <label for="nome_apr" class="labelInput">Nome de Exibição</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="descricao" id="descricao" class="inputuser">
                        <label for="descricao" class="labelInput">Descrição</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="date" name="data_nasc" id="data_nasc" class="inputuser">
                        <label for="data_nasc" class="labelInput">Data de Nascimento</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="number" name="idade" id="idade" class="inputuser">
                        <label for="idade" class="labelInput">Idade</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="cargo" id="cargo" class="inputuser">
                        <label for="cargo" class="labelInput">Cargo (opcional)</label>
                    </div>
                    <div class="input-box">
                        <p class="microtext">Foto de Perfil</p>
                        <input type="file" id="foto" name="foto" class="inputfile">
                        <label for="foto" class="labelfile">Foto de Perfil</label>
                    </div>
                    <br><br><br>
                    <h3>Contatos</h3>
                    <br>
                    <div class="inputBox">
                        <input type="email" name="email" id="email" class="inputuser">
                        <label for="email" class="labelInput">Email</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputuser">
                        <label for="telefone" class="labelInput">Telefone</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="endereco" id="endereco" class="inputuser">
                        <label for="endereco" class="labelInput">Endereço</label>
                    </div>
                    <br><br><br>
                    <div class="buttons">
                        <button type="submit" name="submit" id="submit" class="button edit-profile">Salvar alterações</button>
                        
                    </div>
                    <br>
                </fieldset>
            </form>
            <a href="curriculo.php" class="return-profile"><button class="button">Voltar</button></a>
        </div>
        <article class="area-experiencias">
            <fieldset>
                <legend><b>Editar Experiências</b></legend>
                <br>
                <?php
                echo '<div class="edit-info">';
                    echo '<h2>Escolha uma experiência ou adicione uma nova:</h2>';
                    foreach ($experiencias as $experiencia){
                        if ($experiencia['empresa'] == NULL){
                        }else{
                            echo '<div class="select">';
                                echo '<a href="./partes/edit-experiencias.php?id='.$experiencia['id_experiencia'].'"><h4>'. $experiencia['empresa'] .': </h4><p>'. $experiencia['cargo_empresa'] .'</p></a>';
                            echo '</div>';
                        }
                    }
                    echo '<div class="select">';
                        echo '<a href="./partes/add-experiencias.php?uid='.$id.'"><h3>Adicione uma nova experiência</h3></a>';
                    echo '</div>';
                echo '</div>';
                ?>
            </fieldset>
        </article>
        <article class="area-formacoes">
            <fieldset>
                <legend><b>Editar Formações</b></legend>
                <br>
                <?php
                    echo '<div class="edit-info">';
                        echo '<h2>Escolha uma formação ou adicione uma nova:</h2>';
                        foreach ($formacoes as $formacao){
                            if ($formacao['unidade_ensino'] == NULL){
                            }else{
                                echo '<div class="select">';
                                    echo '<a href="partes/edit-formacao.php?id='.$formacao['id'].'"><h4>'. $formacao['grau_escolaridade'] .':</h4><p> '. $formacao['unidade_ensino'] .'</p></a>';
                                    echo '<br>';
                                echo '</div>';
                            }
                        }
                        echo '<div class="select">';
                            echo '<a href="./partes/add-formacao.php?uid='.$id.'"><h3>Adicione uma nova formação</h3></a>';
                        echo '</div>';
                    echo '</div>';
                ?>
            </fieldset>
        </article>
    </section>
</body>
</html>
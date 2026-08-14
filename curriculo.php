<?php 
require_once 'partes/crud.php';
$id = readOne($pdo, 'dados','id');
$dados = readata($pdo, 'dados','contatos','uid','id = '. $id);
$experiencias = readAll($pdo,'experiencias','uid = '. $id);
$formacoes = readAll($pdo,'formacao','uid = '. $id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="partes/style.css">
    <title>Currículo</title>
</head>
<body>
    <header>
        <h1>Currículo</h1>
    </header>
    <article>
        <?php
            foreach($dados as $info){
                echo '<div class="profile">';
                echo '<div class="profile-name">';
                if ($info['foto'] == NULL){
                    echo '<img src="images/joinha.png" class="profile-img">';
                }else{
                    echo '<img src="'.$info['foto'].'" class="profile-img">';
                }
                echo '<h1>'. $info['nome_apr'] .'</h1>';
                echo '</div>';
                echo '<a href="editar.php?id='.$id.'" class="edit-profile"><button class="button">Editar Perfil</button></a>';
                echo '</div>';
                echo '<div class="info">';
                echo '<h1>Dados Pessoais</h1>';
                echo '<p><b>Nome Completo: </b>'. $info['nome'] .'</p>';
                if ($info['cargo'] == NULL){
                    echo '<p><b>Cargo:</b> Desempregado</p>';
                }else{
                    echo '<p><b>Cargo:</b> '. $info['cargo'] .'</p>';
                }
                echo '<p><b>Data de Nascimento:</b> '. $info['data_nasc'].' ('. $info['idade'] .' anos)</p>';
                if ($info['descricao'] == NULL){
                    echo '<p><b>Descrição:</b> Sem descrição.</p>';
                }else{
                    echo '<p><b>Descrição:</b> '. $info['descricao'].'</p>';
                }
                echo '<br>';
                echo '<h1>Contatos</h1>';
                echo '<p><b>Email:</b> '. $info['email'] .'</p>';
                echo '<p><b>Telefone:</b> '. $info['telefone'] .'</p>';
                echo '<p><b>Endereço:</b> '. $info['endereco'] .'</p>';
                echo '<br>';
                echo '</div>';

                echo '<div class="info">';
                echo '<h1>Experiências</h1>';
                if ($experiencias == NULL){
                    echo '<p>Sem experiência.</p>';
                    echo '<br>';
                }else{
                foreach ($experiencias as $experiencia){
                        echo '<p><b>Nome da Empresa:</b> '. $experiencia['empresa'] .'</p>';
                        echo '<p><b>Cargo:</b> '. $experiencia['cargo_empresa'] .'</p>';
                        echo '<p><b>Data de Admissão:</b> '. $experiencia['data_admissao'] .'</p>';
                        if($experiencia['data_demissao'] == NULL){
                            echo '<p><b>Data de Demissão:</b> Ainda ativo.</p>';
                        }else{
                            echo '<p><b>Data de Demissão:</b> '. $experiencia['data_demissao'] .'</p>';
                        }
                        echo '<br>';
                    }
                    echo '<br>';
                }
                echo '</div>';

                echo '<div class="info">';
                    echo '<h1>Formações</h1>';
                    if ($formacoes == NULL){
                        echo '<p>Sem formação.</p>';
                    }else{
                        foreach ($formacoes as $formacao){
                            echo '<p><b>Unidade de Ensino:</b> '. $formacao['unidade_ensino'] .'</p>';
                            echo '<p><b>Grau de Escolaridade:</b> '. $formacao['grau_escolaridade'] .'</p>';
                            if ($formacao['tipo_curso'] == NULL){
                            }else{
                                echo '<p><b>Tipo do Curso:</b> '. $formacao['tipo_curso'] .'</p>';
                            }
                            echo '<p><b>Situação:</b> '. $formacao['situacao'] .'</p>';
                            echo '<p><b>Data de Entrada:</b> '. $formacao['data_entrada'] .'</p>';
                            echo '<p><b>Data de Conclusão:</b> '. $formacao['data_conclusao'] .'</p>';
                            echo '<br>';
                        }
                    }
                    echo '<br>';
                echo '</div>';
            };
        ?>
    </article>
</body>
</html>
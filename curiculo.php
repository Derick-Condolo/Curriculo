<?php 
require_once 'crud.php';
$dados = readata($pdo, 'dados','contatos','uid','id',);
$id = readOne($pdo, 'dados','id');
$experiencias = readAll($pdo,'experiencias','uid = '.$id);
$formacoes = readAll($pdo,'formacao','uid = '.$id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <title>Curriculo</title>
</head>
<body>
    <div>
        <?php
            foreach($dados as $info){   
                echo '<h1>Dados Pessoais</h1>';
                echo '<p>Nome:'.$info['nome'].'</p>';
                if ($info['cargo'] == NULL){
                    echo '<p>Cargo: Desempregado</p>';
                }else{
                    echo '<p>Cargo: '. $info['cargo'].'</p>';
                }
                echo '<p>Nascimento: '. $info['data_nasc'].'</p>';
                echo '<p>Descrição: '. $info['descricao'].'</p>';
                echo '<br>';
                echo '<h1>Contatos</h1>';
                echo '<p>Email:'.$info['email'].'</p>';
                echo '<p>Telefone: '. $info['telefone'].'</p>';
                echo '<p>Endereço: '. $info['endereco'].'</p>';
                echo '<br>';
                echo '<h1>Experiências</h1>';
                if($experiencias == NULL){
                    echo '<p>Sem experiência.</p>';
                }else{
                    foreach ($experiencias as $experiencia){
                        echo '<p>Nome da Empresa:'.$experiencia['empresa'].'</p>';
                        echo '<p>Cargo: '. $experiencia['cargo_empresa'].'</p>';
                        echo '<p>Data de Admissão: '. $experiencia['data_admissao'].'</p>';
                        echo '<p>Data de Demissão: '. $experiencia['data_demissao'].'</p>';
                        echo '<br>';
                    }
                }
                echo '<h1>Formações</h1>';
                foreach ($formacoes as $formacao){
                    echo '<p>Unidade de Ensino:'.$formacao['unidade_ensino'].'</p>';
                    echo '<p>Grau de Escolaridade: '. $formacao['grau_escolaridade'].'</p>';
                    if ($formacao['tipo_curso'] == NULL){
                    }else{
                        echo '<p>Tipo do Curso: '. $formacao['tipo_curso'].'</p>';
                    };
                    echo '<p>Ano de Entrada: '. $formacao.['data_entrada'].'</p>';
                    echo '<p>Ano de Conclusão: '. $formacao.['data_conclusao'].'</p>';
                    echo '<br>';
                };
            };
        ?>
    </div>
</body>
</html>
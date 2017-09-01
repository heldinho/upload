<?php
    mysql_connect("localhost", "root", "")or die(mysql_error());
    mysql_select_db("upfotos");
    //$admin = md5('admin');
    $conn = new mysqli("localhost", "root", "", "upfotos");
    if ($conn->connect_errno)
    {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }

    $pasta = "fotos/";
    /* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
    
    if(isset($_POST)){
        $nome_imagem    = $_FILES['imagem']['name'];
        $tamanho_imagem = $_FILES['imagem']['size'];
        
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
        
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
            
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / (1024 * 512));
            
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['imagem']['tmp_name']; //caminho temporário da imagem
                
                /* se enviar a foto, insere o nome da foto no banco de dados */
                if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                    mysql_query("INSERT INTO fotos (foto) VALUES ('".$nome_atual."')");
                    echo "<img src='fotos/".$nome_atual."' id='previsualizar'>"; //imprime a foto na tela
                }else{
                    echo "Falha ao enviar";
                }
            }else{
                echo "A imagem deve ser de no máximo 1MB";
            }
        }else{
            echo "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        echo "Selecione uma imagem";
        exit;
    }
   
?>
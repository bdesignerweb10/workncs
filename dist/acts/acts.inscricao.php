<?php
 require_once('connect.php'); $conn->autocommit(FALSE); $id = $_GET['id']; $nome = $_POST["nome"]; $email = $_POST["email"]; $telefone = $_POST["telefone"]; $data_curso = $_POST["data_curso"]; $curso = $_POST["curso"]; $qry_inscricao = "INSERT INTO inscricao (nome, email, telefone, data_curso, cod_curso) VALUES ('" . $nome . "','" . $email . "', '". $telefone ."' ,'" . $data_curso . "','" . $id . "')"; if ($conn->query($qry_inscricao) === TRUE) { $conn->commit(); } else { throw new Exception("Erro ao inserir o evento: " . $qry_inscricao . "<br>" . $conn->error); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Consultoria e treinamentos" />  

    <title>Work NCS</title>
    <link rel="stylesheet" href="../css/style.css">    
    <link rel="stylesheet" href="../css/lightbox.min.css">  
    <script src="../js/main.js"></script> 
</head>
<?php
 if (isset($_POST['nome']) && !empty($_POST['nome'])) { $nome = $_POST['nome']; } if (isset($_POST['email']) && !empty($_POST['email'])) { $email = $_POST['email']; } if (isset($_POST['telefone']) && !empty($_POST['telefone'])) { $telefone = $_POST['telefone']; } $serverEmail = 'contato@worktreinamentos.com.br'; $serverSenha = '#work20ncs18'; $serverNome = 'Website | Work NCS'; $enviaNome = 'Work NCS'; $enviaEmail = 'contato@worktreinamentos.com.br'; $assunto = 'Inscrição de curso'; $msg = 'Mensagem enviada do site Work NCS'.'<br />'; $msg .= '________________________________________________________'.'<br /><br />'; $msg .= 'Nome: '.$nome.'<br />'; $msg .= 'E-mail: '.$email.'<br />'; $msg .= 'Telefone: '.$telefone.'<br />'; $msg .= 'Curso: '.$curso.'<br />'; $msg .= 'Data: '.$data_curso.'<br />'; $msg .= '________________________________________________________'.'<br /><br />'; require_once('../lib/PHPMailer/PHPMailerAutoload.php'); $mail = new PHPMailer(); $mail->IsSMTP(); $mail->SMTPAuth = true; $mail->Charset = 'utf8_decode()'; $mail->Host = 'smtp.'.substr(strstr($serverEmail, '@'), 1); $mail->Port = '587'; $mail->Username = $serverEmail; $mail->Password = $serverSenha; $mail->From = $serverEmail; $mail->FromName = utf8_decode($serverNome); $mail->IsHTML(true); $mail->Subject = utf8_decode($assunto); $mail->Body = utf8_decode($msg); $mail->AddAddress($enviaEmail, utf8_decode($enviaNome)); ?>

<?php  if (!$mail->Send()) { ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ops! Erro ao salvar sua inscrição</h4>
                    </div>
                    <div class="modal-body">                                
                        Ocorreu um erro ao inscrever-se, por favor tente novamente mais tarde.
                    </div>
                    <div class="modal-footer">
                        <a href="../cursos.php"><button type="button" class="btn btn-danger">Fechar</button></a>
                    </div>
                </div>
            </div>
        </div>          
        <script>
            $(document).ready(function () {
                $('#myModal').modal('show');
            });
        </script>    
    <?php  } else { ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Inscrição efetuada com Sucesso!</h4>
                    </div>
                    <div class="modal-body">
                        Obrigado por efetuar sua inscrição, em breve retornaremos.
                    </div>
                    <div class="modal-footer">                            
                        <a href="../cursos.php"><button type="button" class="btn btn-danger">Fechar</button></a>
                    </div>
                </div>
            </div>
        </div>              
        <script>
            $(document).ready(function () {
                $('#myModal').modal('show');
            });
        </script>   
    <?php } ?>
</html>   

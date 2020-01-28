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

	if (isset($_POST['nome']) && !empty($_POST['nome'])) {
		$nome = $_POST['nome'];
	}

	if (isset($_POST['email']) && !empty($_POST['email'])) {
		$email = $_POST['email'];
	}

    if (isset($_POST['telefone']) && !empty($_POST['telefone'])) {
        $telefone = $_POST['telefone'];
    }

	if (isset($_POST['mensagem']) && !empty($_POST['mensagem'])) {
		$mensagem = nl2br($_POST['mensagem']);
	}
	
    $serverEmail = 'otacilio@worktreinamentos.com.br';
    $serverSenha = 'Hoxhbn4657';
    $serverNome = 'Website | Work NCS';

    $enviaNome = 'Work NCS';
    $enviaEmail = 'otacilio@worktreinamentos.com.br';
    $assunto = 'Contato Website Work NCS';

    $msg = 'Mensagem enviada do site Work NCS'.'<br />';
    $msg .= '________________________________________________________'.'<br /><br />';
    $msg .= 'Nome: '.$nome.'<br />';
    $msg .= 'E-mail: '.$email.'<br />';
    $msg .= 'Telefone: '.$telefone.'<br />';
    $msg .= 'Assunto: '.$assunto.'<br />';
    $msg .= '________________________________________________________'.'<br /><br />';
    $msg .= 'Mensagem: "<br />'.$mensagem.'"<br />';

    require_once('../lib/PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Charset = 'utf8_decode()';
    $mail->Host = 'smtp.'.substr(strstr($serverEmail, '@'), 1);
    $mail->Port = '587';
    $mail->Username = $serverEmail;
    $mail->Password = $serverSenha;
    $mail->From = $serverEmail;
    $mail->FromName = utf8_decode($serverNome);
    $mail->IsHTML(true);
    $mail->Subject = utf8_decode($assunto);
    $mail->Body = utf8_decode($msg);

    $mail->AddAddress($enviaEmail, utf8_decode($enviaNome));
?>
<?php 
    if (!$mail->Send()) { ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ops! Erro ao enviar mensagem</h4>
                    </div>
                    <div class="modal-body">                                
                        Ocorreu um erro ao enviar sua mensagem, por favor tente novamente mais tarde.
                    </div>
                    <div class="modal-footer">
                        <a href="../index.php"><button type="button" class="btn btn-danger">Fechar</button></a>
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
                        <h4 class="modal-title" id="myModalLabel">Mensagem enviada com Sucesso!</h4>
                    </div>
                    <div class="modal-body">
                        Obrigado por entrar em contato conosco, em breve retornaremos.
                    </div>
                    <div class="modal-footer">                            
                        <a href="../index.php"><button type="button" class="btn btn-danger">Fechar</button></a>
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


Linha 3 – require_once(“autenvio/PHPMailerAutoload.php”): 
Linha 9 – $mail->Host = “smtp.rodrigozambon.com.br”: 
Linha 14 – $mail->Username = ‘conta-de-email@seudominio.com.br’: Conta que fará o envio das mensagens (deve ser uma conta existente e ativa no seu domínio)
Linha 15 – $mail->Password = ‘senha’: Defina a senha da sua conta de email que fará o envio da mensagem
Linha 18 – $mail->Sender = “conta-de-email@seudominio.com.br”: Conta que fará o envio das mensagens (deve ser uma conta existente e ativa no seu domínio)
Linha 23 – $mail->AddAddress(‘recebe1@dominio.com.br’): Defina a conta que receberá as mensagens

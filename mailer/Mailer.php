<?php 

namespace Mailer; // agrupacion

/* ----- MAILER ----- */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    public $email;
    public $nombre;
    public $token;
    public $type;

    public function __construct($email, $nombre, $token, $type)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        $this->type = $type;
    }

    public function htmlConfirmAccount() // para confirmar nuevo usuario
    {
        $content = '
            <html><style>*{margin: 0; padding: 0; box-sizing: border-box;}html{font-size: 62.5%; font-family: Helvetica;}footer, header{width: 100%; padding: 2rem; background: #0061f7;}footer h1, header h1{color: #fff; font-size: 2rem;}header p{color: #fff; font-size: 1.5rem;}@media screen and (min-width: 600px){footer h1, header h1{font-size: 4rem;}}main{padding: 1rem; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 44rem;}main p{font-size: 1.5rem; margin-bottom: 0.5rem;}main a{text-decoration: none; font-size: 1.5rem; color: #fff; background: #ff4433; padding: 1rem; border-radius: 5px;}</style><body> <header> <h1>upTask</h1> <p>Crea y administra tus proyectos</p></header> <main> <p>Hola '. $this->nombre 
            .', Necesitamos que confirmes tu cuenta antes de continuar</p><p>Solo debes de presionar en el siguiente enlace 😊</p><a href="http://localhost:8080/upTask/auth/confirm?token='. $this->token .'">Confirmar Cuenta</a> </main> <footer> <h1>upTask</h1> </footer></body></html>
        ';
        return $content;
    }

    public function htmlForgettPassword() // si el usuario olvido su contraseña
    {
        $content = '
            <html><style>*{margin: 0; padding: 0; box-sizing: border-box;}html{font-size: 62.5%; font-family: Helvetica;}footer, header{width: 100%; padding: 2rem; background: #0061f7;}footer h1, header h1{color: #fff; font-size: 2rem;}header p{color: #fff; font-size: 1.5rem;}@media screen and (min-width: 600px){footer h1, header h1{font-size: 4rem;}}main{padding: 1rem; width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 44rem;}main p{font-size: 1.5rem; margin-bottom: 0.5rem;}main a{text-decoration: none; font-size: 1.5rem; color: #fff; background: #ff4433; padding: 1rem; border-radius: 5px;}</style><body> <header> <h1>upTask</h1> <p>Crea y administra tus proyectos</p></header> <main> <p>Hola '. $this->nombre 
            .', Hemos resibido tu mensaje para restaurar tu contraseña!</p><p>Solo debes de presionar en el siguiente enlace para continuar con el proceso 😊</p><a href="http://localhost:8080/upTask/auth/restore?token='. $this->token .'">Restaurar Contraseña</a> </main> <footer> <h1>upTask</h1> </footer></body></html>
        ';
        return $content;
    }

    public function send()
    {
        $mail = new PHPMailer(true);
        try{
            //Configuracion del servidor                     
            $mail->isSMTP();                                            
            $mail->Host       = MAIL_HOST;                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = MAIL_USERNAME;                     
            $mail->Password   = MAIL_PASSWORD;                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
            $mail->SMTPSecure = MAIL_ENCRYPTION;         
            $mail->Port       = MAIL_PORT;  

            //Recipientes
            $mail->setFrom('upTask@support.com', 'upTask');
            $mail->addAddress('upTask@support.com', 'Yarol Abraham');
            $mail->addReplyTo('upTask@support.com', 'Informacion de upTask');

            //Contenido
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";                                 
            $mail->Subject = 'Confirmar cuenta upTask';
            /* body */
            if($this->type == "create") $content = $this->htmlConfirmAccount();  
            if($this->type == "forgett") $content = $this->htmlForgettPassword();
            $mail->Body    = $content;
            $mail->AltBody = 'Lo sentimos, no tenemos una alternativa sin html 😢';
            //TODO: continuar con el envio de correo
            if($mail->send()){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }


}
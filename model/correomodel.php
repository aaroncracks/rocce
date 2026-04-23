<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

class correo_model {

    public function enviarcorreoalta($destino) {

        $mail = new PHPMailer(true);

        try {
        // Config SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // TU correo y contraseña
        $mail->Username   = 'gonzalezaaronsantana@gmail.com';
        $mail->Password   = 'mkti nlgv utsl xqes';

        $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
        $mail->Port       = 587;

        // Remitente
        $mail->setFrom('gonzalezaaronsantana@gmail.com', 'Parque Nacional');

        // Destinatario
        $mail->addAddress($destino);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = "Bienvenido al parque nacional";
        $mail->Body    = '<body style="font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px;">

            <table width="100%" style="max-width: 600px; margin: auto; background: #ffffff; border: 1px solid #ddd; padding: 20px; border-radius: 6px;">
                <tr>
                    <td style="text-align: center; padding-bottom: 10px;">
                        <h2 style="margin: 0; color: #2e6b3f;">Parque Nacional Rocce</h2>
                        <small style="color: #555;">Notificación automática</small>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 10px 0; color: #333;">
                        <p>Hola <strong>Usuario</strong>,</p>

                        <p>
                            Se ha dado de alta en nuestro parque, muchas gracias.
                        </p>

                        <p>Si necesitas más información, puedes responder a este correo.</p>

                        <p style="margin-top: 20px;">
                            Atentamente,<br>
                            <strong>Equipo del Parque Nacional Rocce</strong>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; padding-top: 10px; color: #777; font-size: 12px;">
                        © 2025 Parque Nacional Rocce — Todos los derechos reservados.
                    </td>
                </tr>
            </table>

        </body>';

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
    }
}

?>
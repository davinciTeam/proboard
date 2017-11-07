<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;

class Emails {
    public function register($name, $email, $hash)
    {
      
      $mail = new PHPMailer;
      $mail->setFrom('proboard@ws.dvc-icta.nl');

      $mail->addAddress($email);
      $mail->Subject = 'Bevestig u acount by proboard';

      $html = "<html>
                <head>
                    <meta charset=\"utf-8\">
                    <style>
                        * {
                            text-align:center;
                        }
                    </style>
                </head>
                <body> 
                    <p>Meneer/Mevrouw ".$name." bevestig u acount van proboard</p>
                    <a href='http://www.proboard.dvc-icta.nl/dashboard/activation/".$hash."'>bevestig</a>
                </body>
            </html>";

      $mail->msgHTML($html);
      $mail->AltBody = 'bevestig u acount van proboard ga naar http://www.proboard.dvc-icta.nl/dashboard/activation/'.$hash;
      $mail->send();
    }
}
<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail_reservation
{
  private $api_key = 'c43760720bc39003dab817071c9755ae';
  private $api_key_secret = '015a301b623f2a8de7d46208cb8ff628';

  public function send($to_email, $to_name, $subject, $content)
  {
    $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
    $body = [
      'Messages' => [
        [
          'From' => [
            'Email' => "quaiantiquerestaurant@gmail.com",
            'Name' => "Le Quai Antique"
          ],
          'To' => [
            [
              'Email' => $to_email,
              'Name' => $to_name
            ]
          ],
          'TemplateID' => 4750251,
          'TemplateLanguage' => true,
          'Subject' => $subject,
          'Variables' => [
            'content' => $content,
          ]
        ]
      ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success();
  }
}

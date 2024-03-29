<?php

namespace App\Services;

use App\Models\Email;
use App\Models\Action;
use App\Models\Recipiant;
use Spatie\WebhookServer\WebhookCall;

class ActionService {
  public static function trackOpen(
    Email $email,
    Recipiant $recipiant
  ) {
    $action = new Action;
    $action->type = 'open';
    $action->email_id = $email->id;
    $action->recipiant_id = $recipiant->id;
    $action->save();

    if(env('ZAPIER_WEBHOOK') !== false) {
      WebhookCall::create()
      ->url(env('ZAPIER_WEBHOOK'))
      ->payload(
        [
          'from_name' => $email->from_name,
          'from_email' => $email->from_email,
          'subject' => $email->subject,
          'type' => $action->type,
          'recipiant' => $recipiant->email
        ]
      )
      ->useSecret('sign-using-this-secret')
      ->dispatch();
    }

    return $action;
  }

  public static function trackClick(
    Email $email,
    Recipiant $recipiant,
    String $url
  ) {
    $action = new Action;
    $action->type = 'click';
    $action->email_id = $email->id;
    $action->recipiant_id = $recipiant->id;
    $action->url = $url;
    $action->save();

    if (env('ZAPIER_WEBHOOK') !== false) {
      WebhookCall::create()
        ->url(env('ZAPIER_WEBHOOK'))
        ->payload(
          [
            'from_name' => $email->from_name,
            'from_email' => $email->from_email,
            'subject' => $email->subject,
            'type' => $action->type,
            'recipiant' => $recipiant->email,
            'url' => $url,
          ]
        )
        ->useSecret('sign-using-this-secret')
        ->dispatch();
    }

    return $action;
  }

  public static function trackSend(
    Email $email,
    Recipiant $recipiant
  ) {
    $action = new Action;
    $action->type = 'send';
    $action->email_id = $email->id;
    $action->recipiant_id = $recipiant->id;
    $action->save();

    if (env('ZAPIER_WEBHOOK') !== false) {
      WebhookCall::create()
        ->url(env('ZAPIER_WEBHOOK'))
        ->payload(
          [
            'from_name' => $email->from_name,
            'from_email' => $email->from_email,
            'subject' => $email->subject,
            'type' => $action->type,
            'recipiant' => $recipiant->email
          ]
        )
        ->useSecret('sign-using-this-secret')
        ->dispatch();
    }

    return $action;
  }
}
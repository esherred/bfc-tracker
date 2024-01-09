<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Action;
use App\Models\Recipiant;
use Illuminate\Http\Request;
use App\Services\ActionService;
use App\Http\Controllers\Controller;
use Spatie\WebhookServer\WebhookCall;

class ActionController extends Controller
{
  public function send(Request $request)
  {
    if ($request->id && $request->email) {
      $recipiant = Recipiant::firstOrCreate([
        'email' => $request->email
      ]);

      $email = Email::find($request->id);

      if($email) {
        return response(
          ActionService::trackSend(
            $email,
            $recipiant
          ),
          200
        );
      }
    }

    return response([], 200);
  }

  public function open(Request $request)
  {
    if ($request->id && $request->email) {
      $recipiant = Recipiant::firstOrCreate([
        'email' => $request->email
      ]);

      $email = Email::find($request->id);

      if($email) {
        return response(
          ActionService::trackOpen(
            $email,
            $recipiant
          ),
          200
        );
      }
    }

    return response([], 200);
  }

  public function click(Request $request)
  {
    if (
      $request->id && 
      $request->email &&
      $request->url
    ) {
      $recipiant = Recipiant::firstOrCreate([
        'email' => $request->email
      ]);
        
      $email = Email::find($request->id);
        
      if ($email) {
        ActionService::trackClick(
          $email,
          $recipiant,
          $request->url
        );
      }
    } 

    if($request->url) {
      return redirect($request->url);
    } else {
      abort(404, 'Page not found');
    }
  }
}
      
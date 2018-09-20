<?php

namespace Phrontlyne\Http\Controllers;

use Illuminate\Http\Request;

use Phrontlyne\Http\Requests;
use Phrontlyne\Http\Controllers\Controller;
use WhatsapiTool;
use Whatsapi;
use stdClass;

class WhatsappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $number = '233541448708'; # Number with country code
        $type = 'sms'; # This can be either sms or voice

        $response = WhatsapiTool::requestCode($number, $type);
        dd($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmation()
    {
         $number = '233541448708'; # Number with country code
         $code = '956210'; # Replace with received code  

        $response = WhatsapiTool::registerCode($number, $code);
        dd($response);

        //      {#339 ▼
        //   +"status": "ok"
        //   +"login": "233541448708"
        //   +"type": "existing"
        //   +"pw": "n/0S+MerHchMjMfoY1gn3ScA334="
        //   +"expiration": 4444444444.0
        //   +"kind": "free"
        //   +"price": "US$0.99"
        //   +"cost": "0.99"
        //   +"currency": "USD"
        //   +"price_expiration": 1475355482
        // }
    }

   
    public function sendMessage(Request $request)
    {
         $user = new stdClass;
         $user->name = 'Benjamín Martínez Mateos';
         $user->phone = '233541448708';

         $message = "Hello $user->name and welcome to our site";

        $messages = Whatsapi::send($message, function($send) use ($user)
        {
        $send->to($user->phone);

    
        $send->message('Thanks for subscribe');
    });


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

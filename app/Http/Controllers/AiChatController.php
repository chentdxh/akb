<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class AiChatController extends Controller
{
    //

    private   $base_uri = 'http://116.211.26.84:18888/';

    //http://61.152.101.39:3000/Services/AICheck/src/master/doc/protocol.md

    public function rules(Request $request)
    {

        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/app_escape_str_list', [
             RequestOptions::JSON => ['app_id' => '1212']
        ]);

        logger($response->getBody());


        $jRst = json_decode($response->getBody());

        $data['rules'] = $jRst->data->list;
        return view("aichat.rules",$data);
    }


    public function complain_list(Request $request)
    {
        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/complain_list', [
            RequestOptions::JSON => ['app_id' => '1212']
        ]);

        logger($response->getBody());
        return view("aichat.complains");

    }

    public function add_rule(Request $request)
    {

        $rule = $request->input("rule");



        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/add_app_escape_str', [
            RequestOptions::JSON => ['app_id' => '1212', 'escape_str'=>$rule,'remove'=>false]
        ]);

        logger($response->getBody());


        return $this->json_return(0);

    }


    public function del_rule(Request $request)
    {
        $rule = $request->input("rule");


        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/add_app_escape_str', [
            RequestOptions::JSON => ['app_id' => '1212', 'escape_str'=>$rule,'remove'=>true]
        ]);

        logger($response->getBody());
        return $this->json_return(0);
    }


    public function review_complain(Request $request)
    {
        $id = $request->input("id");
        $label = $request->input("label");

        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/review_complain', [
            RequestOptions::JSON => ['app_id' => '1212','id' =>$id,'label'=>$label]
        ]);

        logger($response->getBody());
        return $this->json_return(0);
    }
}

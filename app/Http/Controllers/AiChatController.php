<?php

namespace App\Http\Controllers;

use App\AiChatRule;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\AppInfo;

class AiChatController extends Controller
{
    //

    private   $base_uri = 'http://116.211.26.84:18888/';

    public function apps(Request $request)
    {

        $user = $this->get_user();
        if ($user->role == "super")
        {
            $apps = AppInfo::orderBy("created_at","desc")->paginate(10);

        }else
        {
            $apps = AppInfo::where("uid",$user->uid)->orderBy("created_at","desc")->paginate(10);
        }

        $data['apps'] = $apps;
        return view("aichat.apps",$data);

    }



    //http://61.152.101.39:3000/Services/AICheck/src/master/doc/protocol.md

    public function rules(Request $request)
    {
        $appId = $request->input("appid","default");

        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/app_escape_str_list', [
             RequestOptions::JSON => ['app_id' => $appId]
        ]);

        logger($response->getBody());


        $jRst = json_decode($response->getBody());

        $rules= [];


        if ($jRst->code == 0)
        {
            logger("get rule list");
            foreach ($jRst->data->list as $rule  )
            {
                $aiRule = new AiChatRule();
                $aiRule->rule = $rule;
                $aiRule->appid = $appId;
                array_push($rules,$aiRule);
            }

        }
        $data['appid'] = $appId;
        $data['rules'] = $rules;
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

        $appid = $request->input("appid");
        $rule = $request->input("rule");

        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/add_app_escape_str', [
            RequestOptions::JSON => ['app_id' => $appid, 'escape_str'=>$rule,'remove'=>false]
        ]);

        logger($response->getBody());


        return $this->json_return(0);

    }


    public function del_rule(Request $request)
    {
        $rule = $request->input("rule");
        $appId = $request->input("appid","default");

        $client = new Client(['base_uri' => $this->base_uri]);

        $response = $client->post('/aicheck/add_app_escape_str', [
            RequestOptions::JSON => ['app_id' => $appId, 'escape_str'=>$rule,'remove'=>true]
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

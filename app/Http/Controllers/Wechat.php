<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use Log;
use Overtrue\LaravelWechat\Controllers\EasyWeChatController;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\News;

class Wechat extends Controller
{
    public function shouquan(Request $request){
        $app = app('wechat');
        $oauth = $app->oauth;

// 未登录
        if (!($request -> session() -> has('id'))) {
//            $_SESSION['target_url'] = 'user/profile';
            $request -> session() -> put('target_url','user/profile');

            $response = $oauth -> scopes(['snsapi_userinfo']) ->setRequest($request) ->redirect();
           
            return $response;
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }
// 已经登录过
        $user = session('wechat.oauth_user');
        return $user;
    }
    public function callback(Request $request){
        die('gg22');
        $app = app('wechat');
        $oauth = $app->oauth;

// 获取 OAuth 授权结果用户信息
        $user = $oauth->setRequest($request)->user();
//        $user = session('wechat.oauth_user');
        $request -> session() -> put('wechat_user',$user->toArray());
//        $_SESSION['wechat_user'] = $user->toArray();
        $targetUrl = !$request ->session() -> has('target_url') ? '/' : $request -> session() -> get('target_url');
//        $targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];

      // return redirect($targetUrl);

        header('location:'. $targetUrl); // 跳转到 user/profile
    }
    public function qunfa(){
        Log::info('request arrived.');
        $app = app('wechat');
         $broadcast = $app->broadcast;
        $broadcast->previewTextByName('欢迎关注毛球maoqiu！！！','maoqiu15076067012');
          Log::info('return response.');
          echo "string";
    }
    public function tuwen(){
        $app = app('wechat');
        $news = new News([
                'title' => '接口测试1',
                'description' => '接口测试测试',
                'url' => 'www.baidu.com',
                'image' => 'http://otq91javs.bkt.clouddn.com/im1.jpg',
            ]);

        $app->staff->message($news)->to('oF4mvvw0XiTsWF92wZyF1FItpbQw')->send();
        echo "end";
    }
    public function moban(){
        $app = app('wechat');
        $notice = $app -> notice;
        $messageId = $notice->send(
            [
                'touser' => 'oF4mvvw0XiTsWF92wZyF1FItpbQw',  //user-openId
                'template_id' => 'Xzscf0Po9J6dgVVpCHGvemZu3h3oo8MZ66msBBpi2GE',
                'url' => 'www.baidu.com',
                'data' => [
                    "first" => [
                        "value" => "恭喜你购买成功!",
                        'color' => '#173177'
                    ],
                    "name" => [
                        "value" => "666",
                        'color' => '#457932'
                    ],
                    'price' => [
                        'value' => '男士正装',
                        'color' => 'red'
                    ],
                    'remark' => [
                        'value' => '欢迎再次购买！',
                        'color' => '#173178'
                    ]
                ]
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Log;
use Overtrue\LaravelWechat\Controllers\EasyWeChatController;
use EasyWeChat\Message\Text;

class WechatController extends Controller
{

    public function demo(Application $wechat)
    {
        // $wechat 则为容器中 EasyWeChat\Foundation\Application 的实例
        $wechatServer = EasyWeChat::serve();
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.');
        $app = app('wechat');
 //         $broadcast = $app->broadcast;
 //           $broadcast->sendText('欢迎关注毛球maoqiu！！');

        $app->server->setMessageHandler(function ($message){
            switch ($message->MsgType) {
                case 'event': 
                    switch ($message->Event) {
                    case 'subscribe':return '欢迎关注毛球！！';break;
                    case 'unsubscribe':return 'QAQ...期待您的下次关注哦！';break;
                    default:return 'hello，有什么需要帮助的吗？';break;
                    }
                break;
                case 'text': return '收到文字消息:'.$message->Content; break;
//                 case 'text': return new Text(['content'=>'hello message']); break;
                case 'image': return '收到图片消息:'.$message->MediaId; break;
                case 'voice': return '收到语音消息:'.$message->Format; break;
                case 'video': return '收到视频消息:'.$message->ThumbMediaId; break;
                case 'video': return '收到小视频消息:'.$message->ThumbMediaId; break;
                case 'location': return '收到坐标消息:'.$message->Scale; break;
                case 'link': return '收到链接消息;'.$message->Description; break;
                default : return '收到其它消息';break;
            }
        });
        Log::info('return response.');
        return $app->server->serve();
    }
    public function qunfa(){
        Log::info('request arrived.');
        $app = app('wechat');
         $broadcast = $app->broadcast;
        $broadcast->sendText('欢迎关注毛球maoqiu！！');
          Log::info('return response.');
          echo "string";
    }
    public function tuwen(){
        $app = app('wechat');
        $message = new Text(['content' => 'Hello world!']);
//        $app->server->setMessageHandler(function ($message){
//                return new
//            }
//        });
//        $app->staff->message($message)->to(oF4mvvw0XiTsWF92wZyF1FItpbQw)->send();
        $openId = 'oF4mvvw0XiTsWF92wZyF1FItpbQw';
        $result = $app->staff->message($message)->to($openId)->send();
        echo "end";
    }
}

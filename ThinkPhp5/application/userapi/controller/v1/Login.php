<?php
/**
 * Created by PhpStorm.
 * User: 12155
 * Date: 2019/3/8
 * Time: 14:39
 */

namespace app\userapi\controller\v1;

use app\exception\ParameException;
use app\userapi\controller\UserApi;
use app\userapi\model\UserModel;
use think\facade\Cache;
use think\facade\Config;
use think\Request;

/**
 * 登陆Api
 * Class Login
 * @package app\userapi\controller\v1
 */
class Login extends UserApi
{
    /**
     * @var array
     */
    protected $no_need_token = [
        'login',
        'demo',
    ];

    /**
     * Login constructor.
     * @throws ParameException
     * @throws \app\exception\PowerException
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 登陆接口
     * @author:dsp
     * code             获取微信传过来的code，从而获取openid,server
     * @param Request $request
     * @throws ParameException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @date:2019/3/8 14:50
     */
    public function login(Request $request)
    {
        $code = $request->param('code');

        if (empty($code)) {
            throw new ParameException('缺少code参数');
        }

        //  通过code，获取当前用户的openid和sessionkey,并获取或创建当前用户信息
        $userFind = $this->getOpenidAndSessionKey($code);

        $token['token'] = $this->getToken();
        Cache::rm($token['token']);

        // 缓存用户id
        Cache::set($token['token'],$userFind->id,60*60*3);

        $this->success($token);
    }

    /**
     * 通过code，获取当前用户的openid和sessionkey
     * @author:dsp
     * @param $code
     * @return UserModel
     * @throws ParameException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @date:2019/3/8 15:05
     */
    private function getOpenidAndSessionKey($code)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session';

        $get_data['appid'] = Config::get('wx.appid');
        $get_data['secret'] = Config::get('wx.secret');
        $get_data['js_code'] = $code;
        $get_data['grant_type'] = 'authorization_code';

        $o = "?";
        foreach ( $get_data as $k => $v )
        {
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $get_data = substr($o,0,-1);
        $new_url = $url.$get_data;
        $test = file_get_contents($new_url);
      	      
        $wx_json = json_decode($test);

      	if (@$wx_json->errcode == '40029') {
        	throw new ParameException('无效的code');
        }
      	
        $openid = $wx_json->openid;

        $userFind = UserModel::where('openid','=',$openid)->find();
        if (empty($userFind)) {
            $userFind = new UserModel();
            $userFind->openid = $openid;
            $userFind->create_time = date('Y-m-d H:i:s');
            $userFind->mobile = date('Y-m-d H:i:s');
            $userFind->save();
        }

        return $userFind;
    }

    /**
     * 生成随机token
     * @author:dsp
     * @return string
     * @date:2019/3/8 15:08
     */
    private function getToken()
    {
        $token = time().md5(time() + mt_rand(0, 10000));

        return $token;
    }

    /**
     * 测试使用
     * @author:dsp
     * @param Request $request
     * @date:2019/3/8 14:52
     */
    public function demo(Request $request)
    {
        cache('deng', 520, 7200);
        echo 'demo';
        $a = Cache::get('deng');
        print_r($a);

    }

}
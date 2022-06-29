<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiController;
use Jiannei\Response\Laravel\Support\Facades\Response;

class AuthController extends ApiController
{
    /**
     * @var bool
     * 延时创建开关，获取到微信信息后是否创建用户，在系统有其他注册用户途径时关闭，避免重复创建用户
     * true: 延时创建
     * false: 非延时创建
     */
    protected $DELAYCREATE = false;

    /**
     * 功能有：
     * 假冒登录(test)
     * 登出(logout)
     * 手机号密码登录(mobilePasswordLogin)
     * 邮箱密码登录(emialPasswordLogin)
     * 小程序授权(xcxAuth)
     * 小程序绑定手机(xcxBindMobile)
     * 微信H5授权(wxAuth)
     * 微信绑定手机(wxBindMobile)
     * 邮箱注册(emailRegister)
     * 手机号注册(mobileRegister)
     */

    /**
     * 假冒登录
     *
     * @return void
     */
    public function test()
    {
        $user = User::first();
        if ($user) {
            $token = $user->createToken('token-name');
            return Response::success([
                'user'  => new UserResource($user),
                'token' => $token->plainTextToken
            ]);
        }
        Response::errorBadRequest('假冒登录失败');
    }

    /**
     * 登出
     * Token失效
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return Response::ok('退出成功');
    }

    /**
     * 手机号密码登录
     *
     * @return void
     */
    public function mobilePasswordLogin(Request $request)
    {
        $request->validate(
            [
                'mobile'   => 'required|zh_mobile',
                'password' => 'required'
            ],
            [
                'mobile.required'   => '请输入手机号',
                'mobile.zh_mobile'  => '请输入正确的手机号',
                'password.required' => '请输入密码',
            ]
        );
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            Response::errorBadRequest('手机号或密码不正确');
        }
        if ($user->status === 0) {
            Response::errorBadRequest('账号暂未激活，请联系管理员');
        }
        $token = $user->createToken('token-name');
        return Response::success([
            'user'  => new UserResource($user),
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * 邮箱密码登录
     *
     * @return void
     */
    public function emialPasswordLogin(Request $request)
    {
        $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required'    => '请输入邮箱',
                'email.email'       => '邮箱格式不正确',
                'password.required' => '请输入密码',
            ]
        );
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            Response::errorBadRequest('邮箱或密码不正确');
        }
        if ($user->status === 0) {
            Response::errorBadRequest('账号暂未激活，请联系管理员');
        }
        $token = $user->createToken('token-name');
        return Response::success([
            'user'  => new UserResource($user),
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * 小程序授权
     *
     * https://github.com/overtrue/laravel-wechat
     *
     * @return void
     */
    public function xcxAuth(Request $request)
    {
        $request->validate(
            [
                'code'    => 'required',
                'userInfo' => 'required'
            ],
            [
                'code.required'    => '获取凭证失败',
                'userInfo.required' => '获取用户信息失败',
            ]
        );
        // 获取用户信息
        $fields = [
            'wx_nickname' => $request->input('userInfo.nickName'),
            'gender'      => $request->input('userInfo.gender'),
            'wx_avatar'   => $request->input('userInfo.avatarUrl'),
            'wx_country'  => $request->input('userInfo.country'),
            'wx_province' => $request->input('userInfo.province'),
            'wx_city'     => $request->input('userInfo.city')
        ];

        // 获取openid
        $miniProgram = \EasyWeChat::miniProgram();
        try {
            $result = $miniProgram->auth->session($request->code);
        } catch (\Exception $e) {
            \Log::error('小程序授权发生错误');
            report($e);
            Response::errorBadRequest('发生错误，请稍后重试');
        }
        if (!isset($result['openid'])) {
            \Log::error("小程序授权解析" . json_encode($result));
            Response::errorBadRequest('授权失败，请重新进入小程序');
        }
        $openid = $result['openid'];

        $user = User::where('xcx_openid', $openid)->first();
        if ($user) {
            // 存在用户则更新用户信息
            $user->update($fields);
        } else {
            // 不存在用户
            if ($this->DELAYCREATE) {
                // 延时创建
                return Response::success([
                    'user'       => ['status' => 0],
                    'xcx_openid' => $openid,
                    'token'      => ''
                ]);
            } else {
                // 非延时创建
                $fields['name']       = $request->input('userInfo.nickName');
                $fields['avatar']     = $request->input('userInfo.avatarUrl');
                $fields['xcx_openid'] = $openid;
                $user = User::create($fields);
            }
        }

        if ($user) {
            $token = $user->createToken('token-name');
            return Response::success([
                'session_info' => $result,
                'user'         => new UserResource($user),
                'token'        => $token->plainTextToken
            ]);
        }
    }

    /**
     * 小程序绑定手机
     *
     * https://github.com/overtrue/laravel-wechat
     *
     * @return void
     */
    public function xcxBindMobile(Request $request)
    {
        $request->validate(
            [
                'iv'    => 'required',
                'encryptedData' => 'required',
                'session_key' => 'required',
                'openid' => 'required',
                'userInfo' => 'required'
            ],
            [
                'iv.required'    => '获取凭证失败',
                'encryptedData.required' => '获取凭证失败',
                'session_key.required' => '获取session_key凭证失败',
                'openid.required' => '获取openid失败',
                'userInfo.required' => '获取信息失败'
            ]
        );
        $openid = $request->input('openid');
        $nickName = $request->input('userInfo.nickName');
        $fields = [
            'wx_nickname' => $request->input('userInfo.nickName'),
            'gender'      => $request->input('userInfo.gender'),
            'wx_avatar'   => $request->input('userInfo.avatarUrl'),
            'wx_country'  => $request->input('userInfo.country'),
            'wx_province' => $request->input('userInfo.province'),
            'wx_city'     => $request->input('userInfo.city')
        ];
        // 解密信息
        $miniProgram = \EasyWeChat::miniProgram();
        try {
            $decryptedData = $miniProgram->encryptor->decryptData($request->input('session_key'), $request->input('iv', ''), $request->input('encryptedData', ''));
            $mobile = $decryptedData['purePhoneNumber'];
        } catch (Exception $e) {
            \Log::error('解析微信用户信息发生错误: ' . $nickName);
            Response::errorBadRequest('微信解析失败，请重新进入小程序');
        }

        // 是否绑定手机号
        $user = User::Where('xcx_openid', $openid)->first();

        $fields['mobile'] = $mobile;
        if ($user) {
            $user->update($fields);
        } else {
            $fields['name']       = $request->input('userInfo.nickName');
            $fields['avatar']     = $request->input('userInfo.avatarUrl');
            $fields['xcx_openid'] = $openid;
            $user = User::create($fields);
        }
        $token = $user->createToken('token-name');
        return Response::success([
            'user'       => new UserResource($user),
            'token'      => $token->plainTextToken
        ]);
    }

    /**
     * 微信H5授权
     *
     * https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html#3
     * https://github.com/overtrue/laravel-wechat
     * https://easywechat.vercel.app/6.x/common/oauth.html#%E5%BE%AE%E4%BF%A1-oauth
     *
     * @return void
     */
    public function wxAuth(Request $request)
    {
        $request->validate(
            [
                'code' => 'required'
            ],
            [
                'code.required'    => '获取code失败'
            ]
        );
        // 解密信息
        $app = \EasyWeChat::officialAccount();
        $result = $app->oauth->userFromCode($request->code);
        $openid = $result->getId();

        $fields = [];
        $user = User::where('wx_openid', $openid)->first();
        if ($user) {
            // 存在用户则更新用户信息
            if (isset($result['token_response']) && $result['token_response']['scope'] == 'snsapi_base') {
                // 静默授权
                if (!$user->oauth_scope) {
                    // 不存在授权类型就更新
                    $fields['oauth_scope'] = 1;
                }
            } else {
                // 用户信息授权
                $fields['oauth_scope'] = 2;
                $fields['wx_nickname'] = $result->getName();
                $fields['gender']      = $result['raw']['sex'];
                $fields['wx_avatar']   = $result->getAvatar();
            }
            $user->update($fields);
        } else {
            // 不存在用户

            // 判断授权方式设定对应字段
            if (isset($result['token_response']) && $result['token_response']['scope'] == 'snsapi_base') {
                // 静默授权
                $fields['name'] = '';
                $fields['oauth_scope'] = 1;
            } else {
                // 用户信息授权
                $fields['oauth_scope'] = 2;
                $fields['name']       = $result->getName();
                $fields['avatar']     = $result->getAvatar();
                $fields['wx_nickname'] = $result->getName();
                $fields['gender']      = $result['raw']['sex'];
                $fields['wx_avatar']   = $result->getAvatar();
            }

            if ($this->DELAYCREATE) {
                // 延时创建
                return Response::success([
                    'user'      => ['status' => 0],
                    'wx_user'   => $fields,
                    'wx_openid' => $openid,
                    'token'     => ''
                ]);
            } else {
                // 非延时创建
                $fields['wx_openid'] = $openid;
                $user = User::create($fields);
            }
        }
        if ($user) {
            $token = $user->createToken('token-name');
            return Response::success([
                'user'  => new UserResource($user),
                'wx_openid' => $openid,
                'token' => $token->plainTextToken
            ]);
        }
    }

    /**
     * 微信绑定手机
     *
     * @return void
     */
    public function wxBindMobile(Request $request)
    {
        // $request->validate(
        //     [
        //         'mobile'   => 'required|confirm_mobile_not_change|confirm_rule: mobile_required|zh_mobile',
        //         'code'     => 'required',
        //         'openid'   => 'required'
        //     ],
        //     [
        //         'mobile'                           => '请输入正确的手机号',
        //         'mobile.confirm_mobile_not_change' => '请重新发送验证码',
        //         'mobile.zh_mobile'                 => '电话号码格式不支持',
        //         'code.required'                    => '请输入验证码',
        //         'openid.required'                  => '获取用户openid失败',
        //     ]
        // );

        // 验证

        $wx_openid = $request->input('openid');
        $mobile    = $request->input('mobile');
        $fields = [];
        if ($request->userInfo) {
            $fields['oauth_scope'] = $request->userInfo['oauth_scope'];
            $fields['wx_nickname'] = $request->userInfo['wx_nickname'];
            $fields['gender'] = $request->userInfo['gender'];
            $fields['wx_avatar'] = $request->userInfo['wx_avatar'];
        }

        $user = User::where('wx_openid', $wx_openid)->first();

        $fields['mobile']    = $mobile;
        if ($user) {
            $user->update($fields);
        } else {
            $fields['name']      = $request->userInfo['name'];
            $fields['avatar']    = $request->userInfo['avatar'];
            $fields['wx_openid'] = $wx_openid;
            $user = User::create($fields);
        }
        $token = $user->createToken('token-name');
        return Response::success([
            'user'       => new UserResource($user),
            'token'      => $token->plainTextToken
        ]);
    }

    public function jssdk(Request $request)
    {
        if (config('app.env') == 'local') {
            return null;
        }
        $arr = explode(',', $request->get('apis'));
        $debug = $request->get('debug') === 'true' ? true : false;
        $json = $request->get('json') === 'true' ? true : false;
        $url = $request->get('url');

        // check
        if (!$url) {
            return Response::success(['status' => false, 'msg' => 'params error', 'data' => ''], '参数错误');
        }
        $app = \EasyWeChat::officialAccount();
        $app->jssdk->setUrl($url);
        $config = $app->jssdk->buildConfig($arr, $debug, $json, $url);
        return Response::success(json_decode($config, true));
    }
}

<?php
namespace Home\Controller;
use Think\Controller;

use saeTOAuthV2;
use saeTClientV2;

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest; 
/**
 * 前台登陆注册控制器
 */
class LoginController extends Controller {
	/**
	 * 设置连接redis的属性
	 */
	public function _initialize()
    {
        
        //如果成员属性没有声明，默认就是公有属性
        $this->redis = new \Redis;
        $this->redis->connect('127.0.0.1', 6379);
        // 设置session的最大生命周期
        ini_set("session.gc_maxlifetime", 3600*24*7);
        setcookie(session_name(), session_id(), time() + 3600*24*7);
    }

	/**
     * 发送验证码
     * @param  [integer] $phone [手机号]
     */
    public function send_phone($phone){
        $code=rand(1000,9999);
        require_once  './Api/api_sdk/vendor/autoload.php';    //此处为你放置API的路径
        Config::load();             //加载区域结点配置

        $accessKeyId = 'LTAIusTRTqiGlzib';
        $accessKeySecret = 'C2fRAQDq18djhMMN26VLcOAT2b9O7j';
        $templateCode = 'SMS_116582265';   //短信模板ID

        //短信API产品名（短信产品名固定，无需修改）
        $product = "Dysmsapi";

        //短信API产品域名（接口地址固定，无需修改）
        $domain = "dysmsapi.aliyuncs.com";

        //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
        $region = "cn-hangzhou";

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

        // 增加服务结点
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);

        // 初始化AcsClient用于发起请求
        $acsClient = new DefaultAcsClient($profile);

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);

        // 必填，设置签名名称
        $request->setSignName("卢景昌");

        // 必填，设置模板CODE
        $request->setTemplateCode("SMS_116582265");

        $smsData = array('code'=>$code);    //所使用的模板若有变量 在这里填入变量的值  我的变量名为username此处也为username

        //选填-假如模板中存在变量需要替换则为必填(JSON格式),友情提示:如果JSON中需要带换行符,请参照标准的JSON协议对换行符的要求,比如短信内容中包含\r\n的情况在JSON中需要表示成\\r\\n,否则会导致JSON在服务端解析失败
        $request->setTemplateParam(json_encode($smsData));

        //发起访问请求
        $acsResponse = $acsClient -> getAcsResponse($request);
        //返回请求结果
        $result = json_decode(json_encode($acsResponse), true);
        // return $result;
        $resp = $result['Code'];
        return $this->sendMsgResult($resp,$phone,$code);
    }

    //显示微博授权页面
    public function showWeiBo(){ 
        require_once './Api/libweibo-master/saetv2.ex.class.php';
        $o = new saeTOAuthV2(C('WB_KEY'),C('WB_SEC'));
        //得到授权地址
        $oauth = $o->getAuthorizeURL(C('WB_CALLBACK_URL'));
        //跳转到授权页
        header('Location:'.$oauth); 
    }
    // 处理微博登陆
    public function doWeiBo(){
        require_once './Api/libweibo-master/saetv2.ex.class.php';
        $code = $_GET['code'];
        $keys['code'] = $code;
        $keys['redirect_uri'] = C('WB_CALLBACK_URL');
        $o = new saeTOAuthV2(C('WB_KEY'),C('WB_SEC'));
        $auth = $o->getAccessToken($keys);
        $_SESSION['weibo_accesstoken'] = $auth['access_token'];

        //获取用户信息
        $o2 = new saeTClientV2(C('WB_KEY'),C('WB_SEC'),$_SESSION['weibo_accesstoken']);
        $uid = $o2->get_uid()['uid'];
        //先查看数据库是否有该用户
        $sql_uid = M('UserAuths')->where(['login_name'=>$uid])->find();
        //如果存在，则直接跳转
        if($sql_uid){
            //将唯一标识存在session
            $_SESSION['weibo_uid'] = $uid;
            $this->redirect('Index/index');
        }
        //不存在，则插入数据库
        
        $usr_info = $o2->show_user_by_id($uid);
        //取得用户信息，插入数据库
        $user = M('User');
        $data['username'] = $usr_info['name'];
        $data['photo'] = $usr_info['profile_image_url'];
        $data['addtime'] = time();
        $id = $user->add($data);
        //再插入到用户授权表
        $base['uid'] = $id;
        //登陆类型
        $base['login_type'] = 'weibo';
        //微博标识
        $base['login_name'] = $uid;
        //微博token
        $base['login_pass'] = $_SESSION['weibo_accesstoken'];
        M('UserAuths')->add($base);

        $this->redirect('Index/index');
    }

    public function checkPhone(){
    	$phone = I('phone');
    	//检测手机号是否合法
    	if ($phone){
            if(!preg_match('/^(((13|14|15|18|17)\d{9}))$/',$phone)){
            	$data['info'] = '请输入合法手机号';
            	$data['status'] = 2;
                $this->ajaxReturn($data);
            }
        } else {
        	$this->error('请输入手机号');
        }
    	//查找是否已经注册
        $user = D('User') -> where(['phone'=>$phone]) -> find();
        if ($user) {
            $this->error('手机号已注册');
        }else{
            $this->success('该手机号可以注册');
        }
    }
     /**
     * 数据处理
     */
    public function send_message(){

        $phone=I('phone');
        //检测手机号是否合法
    	if ($phone){
            if(!preg_match('/^(((13|14|15|18|17)\d{9}))$/',$phone)){
            	$data['info'] = '请输入合法手机号';
            	$data['status'] = 2;
                $this->ajaxReturn($data);
            }
        } else {
        	$this->error('请输入手机号');
        }
    	//查找是否已经注册
        $user = D('User') -> where(['phone'=>$phone]) -> find();
        if ($user) {
            $this->error('手机号已注册');
        }else{
            $this->send_phone($phone);
            $this->success('该手机号可以注册');

        }
    }

    /**
     * 验证短信验证码是否有效,前端用jquery validate的remote
     * @return [type] [description]
    */
    public function checkCode(){
        $phone = I('phone');
        $code =  I('code');
        $nowTime = time();
        //从redis查出数据
        $key = 'user:code:'.session_id().':'.$phone;
        $redis_code = $this->redis->hget($key,'code');
        //如果验证码存在，则开始验证，因为验证码只有5分钟的有效期
        if($redis_code){

	        if($code !== $redis_code){
	        	$this->error('验证码错误');
	        }
        } else {
        	$this->error('验证码不存在或过期');
        }

        $this->success('验证码正确');
    }

    /**
     * 验证手机号是否发送成功  前端用ajax，发送成功则提示倒计时，如50秒后可以重新发送
     * @param  [json] $resp  [发送结果]
     * @param  [type] $phone [手机号]
     * @param  [type] $code  [验证码]
     * @return [type]        [description]
     */
    public function sendMsgResult($resp,$phone,$code){
        if ($resp == "OK") {
            $data['code']=$code;
            $key = 'user:code:'.session_id().':'.$phone;
            //设置过期时间
            $result = $this->redis->hMSet($key,$data);
            $this->redis->expire($key,6000);
            if($result){
                $data="发送成功";
            }else{
                $data="发送失败";
            }
        } else{
            $data="发送失败";
        }
        return $data;
    }

    public function test(){
        $ar = $this->send_phone('15992071967');
        dump($ar);
    }
    /**
     * 该页面用来显示登录页面并处理
     * @return void
     */
    public function login(){
    	if(IS_POST){
            $user = M('User');
            //判断用户是否输入了用户名
            if(I('username')==''){
                $this->error('请输入用户名');
            }
            
            //再判断用户是否输入了密码
            if(I('password')==''){
                $this->error('请输入密码');
            }
            //如果错误次数达到2次以上，就要验证验证码
            if($_SESSION['vali_wrong_time'] >=2){
                $verify = new \Think\Verify();
                //判断验证码
                if(!$verify->check(I('validate'))){
                    $this->error('验证码错误');
                }
            }


            //查询用户信息，邮箱或者用户名登陆都可以查询出
            $arr = $user->query("select * from shop_user where username='".I('username')."' or email = '".I('username')."' or phone = '".I('username')."'");

            //判断用户是否存在
            if(!$arr){
                $this->error('该用户不存在，请注册');
            }
            $arr = $arr[0];
            //判断该用户是否已经通过邮箱激活
            if($arr['email_status'] == 0){
                $this->error('请通过邮箱验证激活您的账号');
            }

            //再查询该用户是否被禁用
            if($arr['status'] === '2'){
                //该用户被禁用
                 $this->error('该用户被禁用，请付费解禁');
            }

            //进行密码验证
            //查询授权表的密码
            $password = I('password');//用户输入的密码
            $hash = M('UserAuths')->where(['uid'=>$arr['id']])->find()['login_pass'];//查询出的哈希密码

            //检测用户最近30分钟密码错误次数
            $res = checkPassWrongTime($arr['id']);
            //若错误次数超过限制次数，则锁定30分钟
            if($res === false) {
                //记录密码错误次数
                recordPassWrongTime($arr['id']);
                $this->error('错误次数过多，为了保护账户安全,系统已经将您账户锁定30min');
            }

            if($arr){
                //哈希验证
                if(password_verify($password,$hash)){
                    $_SESSION['HomeUser'] = $arr;
                    session('vali_wrong_time',null);
                    //判断后台是否勾选了免登录
                    if(I('remember')!==''){
                        setcookie('username',I('username'),time()+7*24*3600,'/');
                        setcookie('password',I('password'),time()+7*24*3600,'/');
                        setcookie(session_name(),session_id(),time()+7*24*3600,'/');
                    } else {
                        cookie('username',null);
                        cookie('password',null);
                    }
                    recordTime($arr['id']);

                    //合并购物车redis的缓存到数据库
                    $redis = new \Redis;
                    $redis->connect('127.0.0.1', 6379);
                    //根据session_id得到缓存在redis数据的键
                    $key = 'cart:ids:set:'.session_id();
                    //根据键取集合中的商品id
                    $idArr = $redis->zRange($key, 0, -1);
                    $redis->delete($key);
                    //判断redis是否有购物车的缓存数据
                    if($idArr) {
                        //根据商品id和session_id得到redis的数据
                        for ($i = 0; $i<count($idArr); $i++) {
                            $k = 'cart:datas:'.session_id().':'.$idArr[$i];
                            //获取商品和属性的拼接字符串
                            $gid_infoId = $idArr[$i];
                            //将商品对应的购买量取出遍历存进数组
                            $list[$gid_infoId] = $redis->hGetAll($k);
                            $redis->delete($k);                           
                        }
                        //判断数据库有没有数据
                        $shopcar = M('shopcar');
                        //根据用户id查询购物车的数据
                        $info = $shopcar->where(['uid'=>session('HomeUser')['id']])->find();
                        if(!$info) {
                            //数据库中没有该用户的购物车信息，将redis的数据直接插入到数据库中
                            $list = json_encode($list);
                            $data = ['uid'=>session('HomeUser')['id'],'shopcar'=>$list];
                            $shopcar->add($data);
                        } else {
                            $data = json_decode($info['shopcar'],true);
                            $data = array_merge($data,$list);
                            $data = json_encode($data);
                            $shopcar->where(['uid'=>session('HomeUser')['id']])->save(['shopcar'=>$data]);                            
                        }
                    }
                    //登录后跳回原来的地址             
                    // if(!I('url')==''){
                        // $this->success('登陆成功',I('url'));
                    // } else {
                    $this->success('登陆成功',U('Index/index'));
                    // }
                } else {
                    cookie('username',null);
                    cookie('password',null);
                    //记录密码错误次数
                    recordPassWrongTime($arr['id']);
                    //记录错误次数，用于显示验证码
                    $_SESSION['vali_wrong_time'] += 1; 
                    $this->error('密码错误');
                }
            }
    	} else {
    		$this->display();
    	}
    }

     /**
     * 该页面用来显示注册页面并处理手机注册
     * @return void
     */
    public function register(){
        if(IS_POST){
            $user = D('User');
            if(!I('password')){
                $this->error('密码不能为空');
            }
            if(!I('phone')){
            	$this->error('手机不能为空');
            }
            //创建用于邮箱激活的32位激活码
            // $_POST['token'] = str_shuffle(md5(I('password')));
            //设定该激活码的过期时间
            // $_POST['token_exptime'] = time() + 60*30;
            $vali = $user->create();
            if($vali){
            	//插入数据库
                $vali['username'] = I('phone');
                $vali['email_status'] = 1;
                $id = $user->add($vali);
            	if($id){
                    //插入授权表
                    $base['uid'] = $id;
                    $base['login_type'] = 'phone';
                    $base['login_name'] = I('phone');
                    $base['login_pass'] = password_hash(I('password'),PASSWORD_DEFAULT);
                    if(M('UserAuths')->add($base)){
                		$this->success('恭喜你,注册成功',U('Login/login'));
                    } else {
                        $this->error('注册失败');
                    }
            	} else {
            		$this->error('注册失败');
            	}
            	
                //如果验证成功，就将数据插入数据库
                // if($user->add($vail)){
                //         $res = sendMail(I('email'),'傻逼','感谢您在我站注册了新帐号。<br/>请在30min内点击链接激活您的账号。<br/><a href="http://120.78.178.244/D2/Home/User/verify/verify/'.$_POST['token'].'">http://120.78.178.244/D2/Home/User/verify.html?verify="'.$_POST['token'].'"</a>');
                //         if($res){
                //             $this->success('恭喜你,注册成功<br/>请登录到您的邮箱及时激活您的账号',U('Index/index'));
                //         } else {
                //             $this->error('注册失败');
                //         }
                // } else {
                //     $this->error('注册失败');
                // }
            } else {
                $this->error($user->getError());
            }
        } else {
            $this->display();
        }
    }

    //处理用户名注册
    public function register2(){
        $user = D('User');
        if(!I('password')){
            $this->error('密码不能为空');
        }
        $vali = $user->create();
        if($vali){
            //插入数据库
            $vali['username'] = I('username');
            $vali['email_status'] = 1;
            $id = $user->add($vali);
            if($id){
                //插入授权表
                $base['uid'] = $id;
                $base['login_type'] = 'username';
                $base['login_name'] = I('username');
                $base['login_pass'] = password_hash(I('password'),PASSWORD_DEFAULT);
                if(M('UserAuths')->add($base)){
                    $this->success('恭喜你,注册成功',U('Login/login'));
                } else {
                    $this->error('注册失败');
                }
            } else {
                $this->error('注册失败');
            }
        } else {
            $this->error($user->getError());
        }
    }

    /**
     * 该方法用于前台退出登录账号
     * @return void
     */
    public function logout(){
        //清空session
        session('HomeUser',null);
        session('qq_accesstoken',null);
        session('qq_openid',null);
        session('weibo_accesstoken',null);
        session('weibo_uid',null);
        $this->redirect('login');
    }

}
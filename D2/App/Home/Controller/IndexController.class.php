<?php
namespace Home\Controller;
use Think\Controller;
use Oauth;
use QC;

/**
 * 前台首页控制器
 */
class IndexController extends Controller {
    //初始化数据
     public function _initialize(){

        $seo = M('IndexSeo');
        // 获取seo数据
        $seoarr = $seo->select();
        // 分配数据
        $this->assign('seo',$seoarr);
    }

    public function qiantai(){
        dump($_SESSION);
    }

    //处理QQ登录后，成功则跳转到主页
    public function doQQLogin(){
        require_once './Api/Connect2.1/API/qqConnectAPI.php';
        $oauth = new Oauth();
        $accesstoken = $oauth->qq_callback();
        //取得openid唯一标识
        $openid = $oauth->get_openid();
        $_SESSION['qq_accesstoken'] = $accesstoken;
        $_SESSION['qq_openid'] = $openid;
        //获取用户信息
        $qc = new QC($_SESSION['qq_accesstoken'],$_SESSION['qq_openid']);
        $userinfo = $qc->get_user_info();
        //首先查询数据库是否有该用户
        if(M('UserAuths')->where(['login_name'=>$openid])->find()){
            //如果存在直接跳到主页
             $this->redirect('Index/index');
        }
        //登录成功后把QQ的信息插入到数据库
        //首先插入用户表
        $user = M('User');
        $data['addtime'] = time();
        $data['photo'] = $userinfo['figureurl_2'];
        $data['username'] = $userinfo['nickname'];
        //插入到用户基本信息表，得到插入id
        $id = $user->add($data);
        //再插入到用户授权表
        //用户id
        $base['uid'] = $id;
        //登录类型
        $base['login_type'] = 'qq';
        // QQ唯一标识
        $base['login_name'] = $openid;
        //QQaccess_token
        $base['login_pass'] = $accesstoken;
        if(M('UserAuths')->add($base)){
            $this->redirect('Index/index');
        } else {
            $this->error('授权失败','Login/login');
        }
    }

    //显示QQ登录页面
    public function showQQ(){
        require_once './Api/Connect2.1/API/qqConnectAPI.php';
        $oauth = new Oauth();
        $oauth->qq_login();
    }

	/**
	 * 该操作用来显示商城首页
	 */
    public function index(){
        //只是前台首页遍历友情链接
        $friend = D('Admin/FriendShip');
        $list = $friend->where(['status'=> 1])->select();
        
        $Type = M('Type');
        $typeId = $Type->where(['name'=>'男装'])->find()['id'];
        //遍历男装下的子分类和品牌
        $sonId = $Type->where(['pid'=>$typeId])->select();
        //分配男装下的子分类数据
        $this->assign('son',$sonId);
         //操作轮播图表
        $banner = D('Banner');
        //查询轮播图数据
        $banner = $banner->where(['status' => 1])->limit(5)->getData();
        $tId = $Type->where(['name'=>'女装'])->find()['id'];
        //遍历女装下的子分类的品牌
        $girlId = $Type->where(['pid'=>$tId])->select();
        //分配女装下的子分类数据
        $this->assign('girl',$girlId);
        // 导入第三方类库
        vendor('xunsearch.lib.XS');
        $xs = new \XS('goods');
        $searchobj = $xs->search;
        // 获取热搜词
        $hotwords = $searchobj->getHotQuery(50);
        arsort($hotwords);
        $hotwords = array_slice($hotwords,0,6,true);
        // var_dump($hotwords);
        $search = '';
        // 分配热搜词和提交的搜索词的数据
        $this->assign('hotwords',$hotwords);
        $this->assign('search',$search);
        //查找所有的顶级分类
        $types = $Type->field('id,name')->where(['pid'=>0])->select();

        // 查询是否有缓存
        if(S('ads')){
            $adsarr = S('ads');
            $count = S('count');

        } else {
            //查找广告数据
            $ads = M('ads');
            // 获取广告图片
            $adsarr = $ads->limit(4)->where(['status'=>'1'])->order('id desc')->select();
            // 获取广告总条数
            $num = $ads->where(['status'=>'1'])->count();
            // 判断总条数
            if($num > '4'){
                $count = '4';
            } else {
                $count = $num;
            }
            // 写入缓存
            S('ads',$adsarr,300);
            S('count',$count,300);

        }

        //滚动加载促销商品
        if(IS_AJAX)
        {

            if(I('get.model') == 'hotsale')
            {
                //操作商品表
                $goods = D('Goods');
                //查看是否有缓存
                if(S('allhomepics'))
                {
                    // 有就获取缓存的
                    $pics = S('allhomepics'); 
                } else {
                    //没有则查询数据库
                    $pics = $goods->cache('allhomepics', 60)->field('id, pic')->select();
                }
                //随机取出4张图片
                foreach(array_rand($pics, 4) as $v)
                {
                    $data['pics'][] = $pics[$v];    
                }
                //统计商品总数
                $count = $goods->where(['status' => 2])->count();
                $page = new \Think\Page($count, 6);
                //取出按销量由大到小排序的商品数据
                $hotbuy = $goods->where(['status' => 2])->order('buynum')->limit($page->firstRow, $page->listRows)->getGoodsData();
                $data['hotbuy'] = $hotbuy;
                $data['bigpic'] = $pics[array_rand($pics)];
                $data['data'] = $goods->where(['status' => 4])->limit(5)->order('addtime')->getGoodsData();
                //判断是按那个按钮来更新数据
                if(I('get.demo') == 'hotbuy')
                {
                    $p = $page->firstRow / $page->listRows + 2;
                    if($p > $count / 6) $p = 1;
                    $data = ['hotbuy' => $data['hotbuy'], 'page' => $p];
                } else if(I('get.demo') == 'pics')
                {
                    unset($data['hotbuy']);
                    unset($data['data']);
                } else {
                    // dump($data['pics']);
                    $data = $data;
                }
                $this->ajaxReturn($data);
                exit;
            }
        }
        //如果是微博登陆
        if($_SESSION['weibo_uid']){
            //查询出用户信息
            $uid = M('UserAuths')->where(['login_name'=>$_SESSION['weibo_uid']])->find()['uid'];
            //查出完整用户信息
            $arr = M('User')->where(['id'=>$uid])->find();
            $_SESSION['HomeUser'] = $arr;
        }
        //如果是QQ登录
        if($_SESSION['qq_openid']){
            //查询出用户信息
            $uid = M('UserAuths')->where(['login_name'=>$_SESSION['qq_openid']])->find()['uid'];
            //查出完整用户信息
            $arr = M('User')->where(['id'=>$uid])->find();
            $_SESSION['HomeUser'] = $arr;
        }
        // 分配广告数据
        $this->assign('adsarr',$adsarr);
        $this->assign('count',$count);
        //分配分类数据
        $this->assign('type',$types);
        //分配轮播图数据
        $this->assign('banner',$banner);
        //分配首页数据
        $this->assign('list',$list);

        $this->display();
    }

    /**
     * 获取子分类下的品牌和商品
     */
    public function getBrand(){
        //ajax传过来的子分类id
        $tid = I('tid');
        //不存在则去查
        $brand = M('BrandType');
        $goods = M('Goods');
        $bras = $brand->where(['tid'=>I('tid')])->select();
        $arr = $goods->where(['tid'=>I('tid')])->select();
        foreach ($bras as $k => $v) {
            $bras[$k]['pic'] = M('Brand')->where(['id'=>$v['bid']])->find()['pic'];
        }

        $list['bras'] = $bras;
        $list['goods'] = $arr;
        $this->ajaxReturn($list);
    }

    /**
     * 用于前台ajax获得分类信息
     */
    public function getType(){
        //查询第二级分类ID
        $second = M('Type')->where(['pid'=>I('tid')])->select();
        foreach ($second as $k => $v) {
            $third[] = M('Type')->where(['pid'=>$v['id']])->select();
        }
        $obj = [$second,$third];
        $this->ajaxReturn($obj);
    }
}
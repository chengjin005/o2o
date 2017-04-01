<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class AdminOauthController extends AdminBaseController
{

    // 后台第三方用户列表
    public function index()
    {
        $oauthUserQuery = Db::name('third_party_user');

        $lists = $oauthUserQuery->field('a.*,u.user_nickname,u.sex,u.avatar')->alias('a')->join('__USER__ u','a.user_id = u.id')->where("status", 1)->order("create_time DESC")->paginate(10);
        // 获取分页显示
        $page = $lists->render();
        $this->assign('lists', $lists);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch();
    }

    // 后台删除第三方用户绑定
    public function delete()
    {
        $id = input('param.id', 0, 'intval');
        if (empty($id)) {
            $this->error('非法数据！');
        }
        $result = Db::name("OauthUser")->where("id", $id)->delete();
        if ($result !== false) {
            $this->success("删除成功！", url("admin_oauth/index"));
        } else {
            $this->error('删除失败！');
        }
    }


}
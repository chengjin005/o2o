<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use app\admin\model\AdminMenuModel;

class IndexController extends AdminBaseController
{

    public function _initialize()
    {
        parent::_initialize();

    }

    public function index()
    {
        $adminMenuModel = new AdminMenuModel();
        $menus          = $adminMenuModel->menuTree();

        $this->assign("menus", $menus);

        $admin = Db::name("user")->where('id', 1)->find();
        $this->assign('admin', $admin);
        return $this->fetch();
    }
}

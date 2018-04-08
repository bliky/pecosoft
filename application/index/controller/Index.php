<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Config;
use think\facade\Env;
use think\Container;
use think\Db;

class Index extends Controller
{
  public function index ()
  {
    return $this->fetch();
  }

  public function db_fankui() {
    // customer_consult
    $stuff = 'customer_consult';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];

      $item_new['customer_id'] = $item['customer_id'];
      $item_new['cate'] = 1;
      $item_new['status'] = $item['status'];
      $item_new['sort'] = 1;
      $item_new['contact'] = $item['contact'];
      $item_new['content'] = $item['content'];

      $item_new['create_time'] = $item['create_time'];
      $item_new['delete_time'] = $item['delete_time'];

      $new_list[] = $item_new;
    }
    echo Db::name('fankui')->insertAll($new_list);

    // customer_complain
    $stuff = 'customer_complain';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];

      $item_new['customer_id'] = $item['customer_id'];
      $item_new['cate'] = 2;
      $item_new['status'] = $item['status'];
      $item_new['sort'] = 2;
      $item_new['contact'] = $item['contact'];
      $item_new['content'] = $item['content'];

      $item_new['create_time'] = $item['create_time'];
      $item_new['delete_time'] = $item['detele_time'];

      $new_list[] = $item_new;
    }
    echo Db::name('fankui')->insertAll($new_list);
  }

  public function db_employee() {
    // servicer
    $stuff = 'servicer';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];

      $item_new['id_pre'] = $item['id'];
      $item_new['cate'] = 1;
      $item_new['sort'] = 3;
      $item_new['name'] = $item['name'];
      $item_new['mobile'] = $item['contact'];
      $item_new['user_id'] = $item['user_id'];
      $item_new['account'] = $item['account'];
      $item_new['passwd'] = $item['passwd'];
      $item_new['passwd_init'] = $item['passwd_text'];
      $item_new['provinceid'] = $item['provinceid'];
      $item_new['cityid'] = $item['cityid'];
      $item_new['areaid'] = $item['areaid'];
      $item_new['create_time'] = $item['create_time'];
      $item_new['update_time'] = $item['update_time'];

      $new_list[] = $item_new;
    }
    echo Db::name('employee')->insertAll($new_list);

    // supervisor
    $stuff = 'supervisor';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];

      $item_new['id_pre'] = $item['id'];
      $item_new['cate'] = 2;
      $item_new['sort'] = 2;
      $item_new['status'] = $item['status'];
      $item_new['name'] = $item['name'];
      $item_new['mobile'] = $item['contact'];
      $item_new['user_id'] = $item['user_id'];
      $item_new['account'] = $item['account'];
      $item_new['passwd'] = $item['passwd'];
      $item_new['passwd_init'] = $item['passwd'];
      $item_new['provinceid'] = $item['provinceid'];
      $item_new['cityid'] = $item['cityid'];
      $item_new['areaid'] = $item['areaid'];
      $item_new['create_time'] = $item['create_time'];
      $item_new['update_time'] = $item['update_time'];

      $new_list[] = $item_new;
    }
    echo Db::name('employee')->insertAll($new_list);

    // mender
    $stuff = 'mender';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];

      $item_new['id_pre'] = $item['id'];
      $item_new['cate'] = 3;
      $item_new['sort'] = 1;
      $item_new['name'] = $item['name'];
      $item_new['mobile'] = $item['contact'];
      $item_new['user_id'] = $item['user_id'];
      $item_new['account'] = $item['account'];
      $item_new['passwd'] = $item['passwd'];
      $item_new['passwd_init'] = $item['passwd'];
      $item_new['provinceid'] = $item['provinceid'];
      $item_new['cityid'] = $item['cityid'];
      $item_new['areaid'] = $item['areaid'];
      $item_new['create_time'] = $item['create_time'];
      $item_new['update_time'] = $item['update_time'];

      $new_list[] = $item_new;
    }
    echo Db::name('employee')->insertAll($new_list);
  }

  public function db_product() {
    // product
    $stuff = 'product';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];

      $item_new['id'] = $item['id'];
      $item_new['cate'] = $item['cate'];
      $item_new['name'] = $item['name'];
      $item_new['model'] = $item['model'];
      $item_new['avatar'] = $item['avatar'];
      $item_new['create_time'] = $item['create_time'];

      $new_list[] = $item_new;
    }
    echo Db::name($stuff)->insertAll($new_list);
  }

  public function db_user_user_wechat()
  {
    // user user_wechat
    $stuff = 'user';
    $stuff2 = 'user_wechat';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    $new_list = [];
    $new_list2 = [];
    foreach ($list as $item) {
      $item_new = [];
      $item_new2 = [];

      $item_new['id'] = $item['id'];
      $item_new['name'] = $item['nickname'];
      $item_new['avatar'] = $item['avatar'];
      $item_new['create_time'] = $item['create_time'];
      $item_new['update_time'] = $item['update_time'];
      $item_new['delete_time'] = $item['delete_time'];

      $item_new2['user_id'] = $item['id'];
      $item_new2['openid'] = $item['openid'];
      $item_new2['nickname'] = $item['nickname'];
      $item_new2['avatar'] = $item['avatar'];
      $item_new2['sex'] = $item['sex'];
      $item_new2['create_time'] = $item['create_time'];
      $item_new2['update_time'] = $item['update_time'];
      $item_new2['delete_time'] = $item['delete_time'];

      $new_list[] = $item_new;
      $new_list2[] = $item_new2;
    }
    echo Db::name($stuff)->insertAll($new_list);
    echo Db::name($stuff2)->insertAll($new_list2);
  }

  public function db_same()
  {
    // 数据结构一样的表
    $stuff = 'provinces';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);

    echo Db::name($stuff)->insertAll($list);
  }

  public function db_customer_company()
  {
    $stuff = 'customer';

    $filename = Container::get('app')->getRootPath() . "json/$stuff.json";
    $content = file_get_contents($filename);

    $list = json_decode($content, true);
    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];
      $item_new['id'] = $item['id'];
      $item_new['user_id'] = $item['user_id'];
      $item_new['status'] = $item['status'];
      $item_new['name'] = $item['name'];
      $item_new['mobile'] = $item['contact'];
      $item_new['tel'] = $item['contact'];
      $item_new['create_time'] = $item['create_time'];
      $item_new['update_time'] = $item['update_time'];
      $item_new['delete_time'] = $item['delete_time'];

      $q_rst = Db::table('company')->where('name', $item['company'])->find();
      if ($q_rst) {
        $item_new['company_id'] = $q_rst['id'];
      } else {
        $company = [];
        $company['name'] = $item['company'];
        $company['provinceid'] = $item['provinceid'];
        $company['cityid'] = $item['cityid'];
        $company['areaid'] = $item['areaid'];
        $company['address'] = $item['address'];
        $company['create_time'] = $item['create_time'];
        $company['update_time'] = $item['update_time'];
        $company['delete_time'] = $item['delete_time'];

        $item_new['company_id'] = Db::name('company')->insertGetId($company);
      }

      $new_list[] = $item_new;
    }
    echo Db::name($stuff)->insertAll($new_list);
  }

  public function db_bxorder_rate() {
    // order 中提取订单评价信息
    $filename = Container::get('app')->getRootPath() . 'json/order.json';
    $content = file_get_contents($filename);

    $list = json_decode($content, true);
    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];
      $item_new['order_id_pre'] = $item['id'];
      $item_new['sudu'] = $item['rate_speed'];
      $item_new['taidu'] = $item['rate_attitude'];
      $item_new['jieguo'] = $item['rate_result'];
      $item_new['liyi'] = $item['rate_tech'];
      $item_new['content'] = $item['rate_content'];

      $new_list[] = $item_new;
    }

    echo Db::name('bxorder_rate')->insertAll($new_list);
  }

  public function db_bxorder_fsm() {
    // order_log
    $filename = Container::get('app')->getRootPath() . 'json/order_log.json';
    $content = file_get_contents($filename);

    $list = json_decode($content, true);
    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];
      $item_new['order_id_pre'] = $item['order_id'];
      $item_new['cate'] = $item['role_type'];
      $item_new['employee_id_pre'] = $item['role_id'];
      $item_new['status'] = $item['status'];
      $item_new['name'] = $item['action'];
      $item_new['description'] = $item['content'];

      $item_new['create_time'] = $item['create_time'];
      $item_new['update_time'] = $item['update_time'];
      $item_new['delete_time'] = $item['delete_time'];

      $new_list[] = $item_new;
    }

    $new_list_1000 = array_slice($new_list, 0, 1000);
    $new_list_2000 = array_slice($new_list, 1000, 1000);
    $new_list_3000 = array_slice($new_list, 2000, 1000);
    $new_list_4000 = array_slice($new_list, 3000, 1000);
    $new_list_5000 = array_slice($new_list, 4000, 1000);
    $new_list_6000 = array_slice($new_list, 5000, 1000);
    $new_list_7000 = array_slice($new_list, 6000, 1000);
    $new_list_8000 = array_slice($new_list, 7000, 1000);
    $new_list_9000 = array_slice($new_list, 8000, 1000);
    $new_list_10000 = array_slice($new_list, 9000, 1000);
    $new_list_11000 = array_slice($new_list, 10000, 1000);
    $new_list_12000 = array_slice($new_list, 11000);

    echo Db::name('bxorder_fsm')->insertAll($new_list_1000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_2000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_3000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_4000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_5000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_6000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_7000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_8000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_9000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_10000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_11000) . '<br>';
    echo Db::name('bxorder_fsm')->insertAll($new_list_12000) . '<br>';
  }

  public function db_bxorder_jiean() {
    $filename = Container::get('app')->getRootPath() . 'json/order_end.json';
    $content = file_get_contents($filename);

    $list = json_decode($content, true);
    $new_list = [];
    foreach ($list as $item) {
      $item_new = [];
      $item_new['order_id_pre'] = $item['order_id'];
      $item_new['num'] = $item['num'];
      $item_new['date'] = $item['date'];
      $item_new['cate'] = $item['type'];
      $item_new['charged'] = $item['charged'];
      $item_new['fittings'] = $item['fittings'];
      $item_new['content'] = $item['content'];
      $item_new['comment'] = $item['comment'];
      $item_new['create_time'] = $item['create_time'];
      $item_new['update_time'] = $item['update_time'];
      $item_new['delete_time'] = $item['delete_time'];

      $new_list[] = $item_new;
    }
    echo Db::name('bxorder_jiean')->insertAll($new_list);
  }

  public function db_order()
  {
    //echo Config::get('app_host');
    $filename = Container::get('app')->getRootPath() . 'json/order.json';
    $content = file_get_contents($filename);

    $order_list = json_decode($content, true);
    $order_new_list = [];
    foreach ($order_list as $order) {
      $order_new = [];
      $order_new['id'] = $order['id'];
      $order_new['id_pre'] = $order['id'];
      $order_new['customer_id'] = $order['customer_id'];
      $order_new['product_id'] = $order['product_id'];
      $order_new['sn'] = $order['sn'];
      $order_new['cate'] = $order['type'];
      $order_new['status'] = $order['status'];
      $order_new['description'] = $order['description'];
      $order_new['create_time'] = $order['create_time'];
      $order_new['update_time'] = $order['update_time'];
      $order_new['delete_time'] = $order['delete_time'];

      $order_new_list[] = $order_new;
    }
    echo Db::name('order')->insertAll($order_new_list);
  }
}

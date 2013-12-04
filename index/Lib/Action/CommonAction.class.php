<?php
class CommonAction extends Action {
  public function _initialize(){
    //Link
    $this -> assign('link', M('Link') -> field('name,link') -> order('sort ASC') -> select());
    //记录访问量,单个IP每小时统计一次
    $time = strtotime('-1 hours');
    $where_ip = array();
    $where_ip['ip'] = get_client_ip();
    $where_ip['time'] = array('GT', $time);

    if(!M('IpLog') -> where($where_ip) -> find()){
      M('System') -> where('name="traffic"') -> setInc('value');
      M('IpLog') -> add(array('ip' => $where_ip['ip'], 'time' => time()));
    }
    $where_del_ip = array();
    $where_del_ip['time'] = array('LT', $time);
    M('IpLog') -> where($where_del_ip) -> delete();
    $traffic = M('System') -> getFieldByname('traffic', 'value');
    $this -> assign('traffic', $traffic);
  }
}

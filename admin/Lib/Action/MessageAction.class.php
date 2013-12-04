<?php
class MessageAction extends CommonAction {
  public function message(){
    $Question = M('Question');
    $where = array();
    if(!empty($_POST['content'])){
      $where['content'] = array('LIKE', '%' . $this -> _post('content') . '%');
    }
    //记录总数
    $count = $Question -> where($where) -> count('id');
    import('ORG.Util.Page');
    if(! empty ( $_REQUEST ['listRows'] )){
      $listRows = $_REQUEST ['listRows'];
    } else {
      $listRows = 15;
    }
    $page = new Page($count, $listRows);
    //当前页数
    $pageNum = !empty($_REQUEST['pageNum']) ? $_REQUEST['pageNum'] : 1;
    $page -> firstRow = ($pageNum - 1) * $listRows;
    $result = $Question -> field('id,content,addtime,reply,ischeck') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function delmessage(){
    $Question = M('Question');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($Question -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editmessage(){
    $Question = M('Question');
    if(!empty($_POST['content'])){
      if(!$Question -> create()){
	$this -> error($Question -> getError());
      }
      if($Question -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $Question -> field('name,sex,address,mobilephone,qqcode,email,content,reply') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();

  }

  public function passauditmessage(){
    $Question = M('Question');
    $where_audit = array();
    $where_audit['id'] = array('IN', $this -> _post('ids'));  
    $data_audit = array('ischeck' => 2);
    if($Question -> where($where_audit) -> save($data_audit)){
      $this -> success(L('DATA_UPDATE_SUCCESS'));
    }else{
      $this -> error(L('DATA_UPDATE_ERROR'));
    }
  }

  public function nopassauditmessage(){
    $Question = M('Question');
    $where_audit = array();
    $where_audit['id'] = array('IN', $this -> _post('ids'));  
    $data_audit = array('ischeck' => 1);
    if($Question -> where($where_audit) -> save($data_audit)){
      $this -> success(L('DATA_UPDATE_SUCCESS'));
    }else{
      $this -> error(L('DATA_UPDATE_ERROR'));
    }
  }
}

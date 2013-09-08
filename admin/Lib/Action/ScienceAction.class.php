<?php
class ScienceAction extends CommonAction {
  public function nowactivity(){
    $ScienceNowactivity = M('ScienceNowactivity');
    $where = array();
    if(!empty($_POST['title'])){
      $where['title'] = array('LIKE', '%' . $this -> _post('title') . '%');
    }
    //记录总数
    $count = $ScienceNowactivity -> where($where) -> count('id');
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
    $result = $ScienceNowactivity -> field('id,title,addtime') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addnowactivity(){
    if(!empty($_POST['title'])){
      $ScienceNowactivity = M('ScienceNowactivity');
      if(!$ScienceNowactivity -> create()){
	$this -> error($ScienceNowactivity -> getError());
      }
      $ScienceNowactivity -> addtime = time();
      if($ScienceNowactivity -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function delnowactivity(){
    $ScienceNowactivity = M('ScienceNowactivity');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($ScienceNowactivity -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editnowactivity(){
    $ScienceNowactivity = M('ScienceNowactivity');
    if(!empty($_POST['title'])){
      if(!$ScienceNowactivity -> create()){
	$this -> error($ScienceNowactivity -> getError());
      }
      if($ScienceNowactivity -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $ScienceNowactivity -> field('title,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }

  public function oldactivity(){
    $ScienceOldactivity = M('ScienceOldactivity');
    $where = array();
    if(!empty($_POST['title'])){
      $where['title'] = array('LIKE', '%' . $this -> _post('title') . '%');
    }
    //记录总数
    $count = $ScienceOldactivity -> where($where) -> count('id');
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
    $result = $ScienceOldactivity -> field('id,title,addtime') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addoldactivity(){
    if(!empty($_POST['title'])){
      $ScienceOldactivity = M('ScienceOldactivity');
      if(!$ScienceOldactivity -> create()){
	$this -> error($ScienceOldactivity -> getError());
      }
      $ScienceOldactivity -> addtime = time();
      if($ScienceOldactivity -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function deloldactivity(){
    $ScienceOldactivity = M('ScienceOldactivity');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($ScienceOldactivity -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editoldactivity(){
    $ScienceOldactivity = M('ScienceOldactivity');
    if(!empty($_POST['title'])){
      if(!$ScienceOldactivity -> create()){
	$this -> error($ScienceOldactivity -> getError());
      }
      if($ScienceOldactivity -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $ScienceOldactivity -> field('title,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }
}


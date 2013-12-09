<?php
class AboutAction extends CommonAction {
  public function introduction(){
    $About = M('About');
    if(!empty($_POST['content'])){
      $where['name'] = $this -> _post('name');
      $data['content'] = $_POST['content'];
      if($About -> where($where) -> save($data)){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $About -> getFieldByname(ACTION_NAME, 'content');
    $this -> assign('result', $result);
    $this -> display();
  }

  public function charter(){
    $About = M('About');
    if(!empty($_POST['content'])){
      $where['name'] = $this -> _post('name');
      $data['content'] = $_POST['content'];
      if($About -> where($where) -> save($data)){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $About -> getFieldByname(ACTION_NAME, 'content');
    $this -> assign('result', $result);
    $this -> display();
  }

  public function dynamic(){
    $AboutDynamic = M('AboutDynamic');
    $where = array();
    if(!empty($_POST['title'])){
      $where['title'] = array('LIKE', '%' . $this -> _post('title') . '%');
    }
    //记录总数
    $count = $AboutDynamic -> where($where) -> count('id');
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
    $result = $AboutDynamic -> field('id,title,addtime') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function adddynamic(){
    if(!empty($_POST['title'])){
      $AboutDynamic = M('AboutDynamic');
      if(!$AboutDynamic -> create()){
	$this -> error($AboutDynamic -> getError());
      }
      $AboutDynamic -> addtime = time();
      if($AboutDynamic -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function deldynamic(){
    $AboutDynamic = M('AboutDynamic');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($AboutDynamic -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editdynamic(){
    $AboutDynamic = M('AboutDynamic');
    if(!empty($_POST['title'])){
      if(!$AboutDynamic -> create()){
	$this -> error($AboutDynamic -> getError());
      }
      if($AboutDynamic -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $AboutDynamic -> field('title,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }

  public function member(){
    $About = M('About');
    if(!empty($_POST['content'])){
      $where['name'] = $this -> _post('name');
      $data['content'] = $_POST['content'];
      if($About -> where($where) -> save($data)){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $About -> getFieldByname(ACTION_NAME, 'content');
    $this -> assign('result', $result);
    $this -> display();
  }
}

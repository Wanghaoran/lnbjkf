<?php
class LinkAction extends CommonAction {

  public function links(){
    $Link = M('Link');
    $where = array();
    if(!empty($_POST['name'])){
      $where['name'] = array('LIKE', '%' . $this -> _post('name') . '%');
    }
    //记录总数
    $count = $Link -> where($where) -> count('id');
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
    $result = $Link -> field('id,name,link,sort,remark') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('sort ASC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addlinks(){
    if(!empty($_POST['name'])){
      $Link = M('Link');
      if(!$Link -> create()){
	$this -> error($Link -> getError());
      }
      if($Link -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function dellinks(){
    $Link = M('Link');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($Link -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editlinks(){
    $Link = M('Link');
    if(!empty($_POST['name'])){
      if(!$Link -> create()){
	$this -> error($Link -> getError());
      }
      if($Link -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $Link -> field('name,link,sort,remark') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }

}

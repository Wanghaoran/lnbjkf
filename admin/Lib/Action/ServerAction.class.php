<?php
class ServerAction extends CommonAction {

  public function technocracy(){
    $Server = M('Server');
    $where = array();
    if(!empty($_POST['name'])){
      $where['name'] = array('LIKE', '%' . $this -> _post('name') . '%');
    }
    //记录总数
    $count = $Server -> where($where) -> count('id');
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
    $result = $Server -> field('id,name,addtime') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addtechnocracy(){
    if(!empty($_POST['name'])){
      $Server = M('Server');
      if(!$Server -> create()){
	$this -> error($Server -> getError());
      }
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$Server -> pic = $info[0]['savename']; 
      }
      $Server -> addtime = time();

      if($Server -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function deltechnocracy(){
    $Server = M('Server');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($Server -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function edittechnocracy(){
    $Server = M('Server');
    if(!empty($_POST['name'])){
      if(!$Server -> create()){
	$this -> error($Server -> getError());
      }
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$Server -> pic = $info[0]['savename']; 
      }
      if($Server -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $Server -> field('name,remark,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }
}

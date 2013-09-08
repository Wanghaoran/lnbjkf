<?php
class ExpertAction extends CommonAction {

  public function technocracy(){
    $Expert = M('Expert');
    $where = array();
    if(!empty($_POST['name'])){
      $where['name'] = array('LIKE', '%' . $this -> _post('name') . '%');
    }
    //记录总数
    $count = $Expert -> where($where) -> count('id');
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
    $result = $Expert -> field('id,name,addtime') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
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
      $Expert = M('Expert');
      if(!$Expert -> create()){
	$this -> error($Expert -> getError());
      }
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$Expert -> pic = $info[0]['savename']; 
      }
      $Expert -> addtime = time();

      if($Expert -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function deltechnocracy(){
    $Expert = M('Expert');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($Expert -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function edittechnocracy(){
    $Expert = M('Expert');
    if(!empty($_POST['name'])){
      if(!$Expert -> create()){
	$this -> error($Expert -> getError());
      }
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$Expert -> pic = $info[0]['savename']; 
      }
      if($Expert -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $Expert -> field('name,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }
}

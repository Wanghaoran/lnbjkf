<?php
class KnowledgeAction extends CommonAction {
  public function publicknowledgecategory(){
    $KnowledgePublicknowledgecategory = M('KnowledgePublicknowledgecategory');
    $where = array();
    if(!empty($_POST['name'])){
      $where['name'] = array('LIKE', '%' . $this -> _post('name') . '%');
    }
    //记录总数
    $count = $KnowledgePublicknowledgecategory -> where($where) -> count('id');
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
    $result = $KnowledgePublicknowledgecategory -> field('id,name,sort,remark') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('sort ASC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addpublicknowledgecategory(){
    if(!empty($_POST['name'])){
      $KnowledgePublicknowledgecategory = M('KnowledgePublicknowledgecategory');
      if(!$KnowledgePublicknowledgecategory -> create()){
	$this -> error($KnowledgePublicknowledgecategory -> getError());
      }
      if($KnowledgePublicknowledgecategory -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function delpublicknowledgecategory(){
    $KnowledgePublicknowledgecategory = M('KnowledgePublicknowledgecategory');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($KnowledgePublicknowledgecategory -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editpublicknowledgecategory(){
    $KnowledgePublicknowledgecategory = M('KnowledgePublicknowledgecategory');
    if(!empty($_POST['name'])){
      if(!$KnowledgePublicknowledgecategory -> create()){
	$this -> error($KnowledgePublicknowledgecategory -> getError());
      }
      if($KnowledgePublicknowledgecategory -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $KnowledgePublicknowledgecategory -> field('name,sort,remark') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }

  public function specialtyknowledgecategory(){
    $KnowledgeSpecialtyknowledgecategory = M('KnowledgeSpecialtyknowledgecategory');
    $where = array();
    if(!empty($_POST['name'])){
      $where['name'] = array('LIKE', '%' . $this -> _post('name') . '%');
    }
    //记录总数
    $count = $KnowledgeSpecialtyknowledgecategory -> where($where) -> count('id');
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
    $result = $KnowledgeSpecialtyknowledgecategory -> field('id,name,sort,remark') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('sort ASC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addspecialtyknowledgecategory(){
    if(!empty($_POST['name'])){
      $KnowledgeSpecialtyknowledgecategory = M('KnowledgeSpecialtyknowledgecategory');
      if(!$KnowledgeSpecialtyknowledgecategory -> create()){
	$this -> error($KnowledgeSpecialtyknowledgecategory -> getError());
      }
      if($KnowledgeSpecialtyknowledgecategory -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    $this -> display();
  }

  public function delspecialtyknowledgecategory(){
    $KnowledgeSpecialtyknowledgecategory = M('KnowledgeSpecialtyknowledgecategory');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($KnowledgeSpecialtyknowledgecategory -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editspecialtyknowledgecategory(){
    $KnowledgeSpecialtyknowledgecategory = M('KnowledgeSpecialtyknowledgecategory');
    if(!empty($_POST['name'])){
      if(!$KnowledgeSpecialtyknowledgecategory -> create()){
	$this -> error($KnowledgeSpecialtyknowledgecategory -> getError());
      }
      if($KnowledgeSpecialtyknowledgecategory -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $KnowledgeSpecialtyknowledgecategory -> field('name,sort,remark') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $this -> display();
  }

  public function publicknowledgearticle(){
    $KnowledgePublicknowledgearticle = M('KnowledgePublicknowledgearticle');
    $where = array();
    if(!empty($_POST['title'])){
      $where['title'] = array('LIKE', '%' . $this -> _post('title') . '%');
    }
    //记录总数
    $count = $KnowledgePublicknowledgearticle -> where($where) -> count('id');
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
    $result = $KnowledgePublicknowledgearticle -> alias('a') -> field('a.id,a.title,a.addtime,c.name as cname,a.isinsideleft,a.isindexpic,a.isindexleft') -> join('laonian_knowledge_publicknowledgecategory as c ON a.cid = c.id') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addpublicknowledgearticle(){

    if(!empty($_POST['title'])){
      $KnowledgePublicknowledgearticle = M('KnowledgePublicknowledgearticle');
      if(!$KnowledgePublicknowledgearticle -> create()){
	$this -> error($KnowledgePublicknowledgearticle -> getError());
      }
      $KnowledgePublicknowledgearticle -> addtime = time();
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$KnowledgePublicknowledgearticle -> pic = $info[0]['savename']; 
      }
      if($KnowledgePublicknowledgearticle -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    
    $result_category = M('KnowledgePublicknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('result_category', $result_category);
    $this -> display();
  }

  public function delpublicknowledgearticle(){
    $KnowledgePublicknowledgearticle = M('KnowledgePublicknowledgearticle');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($KnowledgePublicknowledgearticle -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editpublicknowledgearticle(){
    $KnowledgePublicknowledgearticle = M('KnowledgePublicknowledgearticle');
    if(!empty($_POST['title'])){
      if(!$KnowledgePublicknowledgearticle -> create()){
	$this -> error($KnowledgePublicknowledgearticle -> getError());
      }
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$KnowledgePublicknowledgearticle -> pic = $info[0]['savename']; 
      }
      $KnowledgePublicknowledgearticle -> isinsideleft = $_POST['isinsideleft'] == 1 ? 1 : 0;
      $KnowledgePublicknowledgearticle -> isindexpic = $_POST['isindexpic'] == 1 ? 1 : 0;
      $KnowledgePublicknowledgearticle -> isindexleft = $_POST['isindexleft'] == 1 ? 1 : 0;
      if($KnowledgePublicknowledgearticle -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $KnowledgePublicknowledgearticle -> field('cid,title,content,isinsideleft,isindexpic,isindexleft') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $result_category = M('KnowledgePublicknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('result_category', $result_category);
    $this -> display();
  }

  public function specialtyknowledgearticle(){
    $KnowledgeSpecialtyknowledgearticle = M('KnowledgeSpecialtyknowledgearticle');
    $where = array();
    if(!empty($_POST['title'])){
      $where['title'] = array('LIKE', '%' . $this -> _post('title') . '%');
    }
    //记录总数
    $count = $KnowledgeSpecialtyknowledgearticle -> where($where) -> count('id');
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
    $result = $KnowledgeSpecialtyknowledgearticle -> alias('a') -> field('a.id,a.title,a.addtime,c.name as cname,a.isinsideleft,a.isindexpic,a.isindexleft') -> join('laonian_knowledge_specialtyknowledgecategory as c ON a.cid = c.id') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    //每页条数
    $this -> assign('listRows', $listRows);
    //当前页数
    $this -> assign('currentPage', $pageNum);
    $this -> assign('count', $count);
    $this -> display();
  }

  public function addspecialtyknowledgearticle(){

    if(!empty($_POST['title'])){
      $KnowledgeSpecialtyknowledgearticle = M('KnowledgeSpecialtyknowledgearticle');
      if(!$KnowledgeSpecialtyknowledgearticle -> create()){
	$this -> error($KnowledgeSpecialtyknowledgearticle -> getError());
      }
      $KnowledgeSpecialtyknowledgearticle -> addtime = time();
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$KnowledgeSpecialtyknowledgearticle -> pic = $info[0]['savename']; 
      }
      if($KnowledgeSpecialtyknowledgearticle -> add()){
	$this -> success(L('DATA_ADD_SUCCESS'));
      }else{
	$this -> error(L('DATA_ADD_ERROR'));
      }
    }
    
    $result_category = M('KnowledgeSpecialtyknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('result_category', $result_category);
    $this -> display();
  }

  public function delspecialtyknowledgearticle(){
    $KnowledgeSpecialtyknowledgearticle = M('KnowledgeSpecialtyknowledgearticle');
    $where_del = array();
    $where_del['id'] = array('in', $_POST['ids']);
    if($KnowledgeSpecialtyknowledgearticle -> where($where_del) -> delete()){
      $this -> success(L('DATA_DELETE_SUCCESS'));
    }else{
      $this -> error(L('DATA_DELETE_ERROR'));
    }
  }

  public function editspecialtyknowledgearticle(){
    $KnowledgeSpecialtyknowledgearticle = M('KnowledgeSpecialtyknowledgearticle');
    if(!empty($_POST['title'])){
      if(!$KnowledgeSpecialtyknowledgearticle -> create()){
	$this -> error($KnowledgeSpecialtyknowledgearticle -> getError());
      }
      if($_FILES['pic']['size'] != 0){
	$info = R('Public/pic_upload');
	$KnowledgeSpecialtyknowledgearticle -> pic = $info[0]['savename']; 
      }
      $KnowledgeSpecialtyknowledgearticle -> isinsideleft = $_POST['isinsideleft'] == 1 ? 1 : 0;
      $KnowledgeSpecialtyknowledgearticle -> isindexpic = $_POST['isindexpic'] == 1 ? 1 : 0;
      $KnowledgeSpecialtyknowledgearticle -> isindexleft = $_POST['isindexleft'] == 1 ? 1 : 0;
      if($KnowledgeSpecialtyknowledgearticle -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $KnowledgeSpecialtyknowledgearticle -> field('cid,title,content,isinsideleft,isindexpic,isindexleft') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $result_category = M('KnowledgeSpecialtyknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('result_category', $result_category);
    $this -> display();
  }
}


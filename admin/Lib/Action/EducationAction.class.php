<?php
class EducationAction extends CommonAction {

  public function content(){
    $Education = M('Education');
    if(!empty($_POST['content'])){
      if(!$Education -> create()){
	$this -> error($Education -> getError());
      }
      if($Education -> save()){
	$this -> success(L('DATA_UPDATE_SUCCESS'));
      }else{
        $this -> error(L('DATA_UPDATE_ERROR'));
      }
    }
    $result = $Education -> getFieldByid('1', 'content');
    $this -> assign('result', $result);
    $this -> display();
  }
}

<?php
class MessageAction extends CommonAction {
  public function index(){
    if(!empty($_POST['content'])){
      $Question = M('Question');
      $Question -> create();
      $Question -> addtime = time();
      if($Question -> add()){
	header("Content-type: text/html; charset=utf-8");
	echo '<script>alert("留言成功！管理员审核后可见！");location.href="' . __ROOT__ . '/message/show"</script>';
      }else{
	echo '<script>alert("留言失败！请和管理员取得联系！");location.href="' . __ROOT__ . '/message"</script>';
      }
      exit();
    }
    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }

  public function show(){
    $Question = M('Question');
    import("ORG.Util.Page");// 导入分页类
    $count = $Question -> where('ischeck=2') -> count('id');
    $page = new Page($count, 5);//每页10条
    $page->setConfig('header','条留言');
    $show = $page -> show();
    $result = $Question -> field('id,content,reply') -> order('addtime DESC') -> limit($page -> firstRow . ',' . $page -> listRows) -> where('ischeck=2') -> select();
    $this -> assign('result', $result);
    $this -> assign('show', $show);

    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }
}

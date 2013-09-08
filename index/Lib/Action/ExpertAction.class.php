<?php
class ExpertAction extends CommonAction {
  public function teacherlist(){
    $Expert = M('Expert');
    import("ORG.Util.Page");// 导入分页类
    $count = $Expert -> count('id');
    $page = new Page($count, 6);//每页10条
    $page->setConfig('header','位专家');
    $show = $page -> show();
    $result = $Expert -> field('id,name,pic,content') -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    $this -> assign('show', $show);
    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }

  public function teacherinfo(){
    $Expert = M('Expert');
    $result = $Expert -> field('name,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }
}

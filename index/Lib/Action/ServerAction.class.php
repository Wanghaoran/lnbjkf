<?php
class ServerAction extends CommonAction {
  public function serverlist(){
    $Server = M('Server');
    import("ORG.Util.Page");// 导入分页类
    $count = $Server -> count('id');
    $page = new Page($count, 3);//每页10条
    $page->setConfig('header','个企业');
    $show = $page -> show();
    $result = $Server -> field('id,pic,remark') -> order('addtime DESC') -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
    $this -> assign('result', $result);
    $this -> assign('show', $show);

    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }

  public function serverinfo(){
    $Server = M('Server');
    $result = $Server -> field('name,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }
}

<?php
class ScienceAction extends CommonAction {
  public function newactivity(){
    $ScienceNowactivity = M('ScienceNowactivity');
    import("ORG.Util.Page");// 导入分页类
    $count = $ScienceNowactivity -> count('id');
    $page = new Page($count, 10);//每页10条
    $page->setConfig('header','条新闻');
    $show = $page -> show();
    $result = $ScienceNowactivity -> field('id,title,addtime') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    $this -> assign('show', $show);

    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }

  public function oldactivity(){
    $ScienceOldactivity = M('ScienceOldactivity');
    import("ORG.Util.Page");// 导入分页类
    $count = $ScienceOldactivity -> count('id');
    $page = new Page($count, 10);//每页10条
    $page->setConfig('header','条新闻');
    $show = $page -> show();
    $result = $ScienceOldactivity -> field('id,title,addtime') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('addtime DESC') -> select();
    $this -> assign('result', $result);
    $this -> assign('show', $show);

    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);

    $this -> display();
  }

  public function newinfo(){
    $ScienceNowactivity = M('ScienceNowactivity');
    $result = $ScienceNowactivity -> field('title,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);

    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);

    $this -> display();
  }

  public function oldinfo(){
    $ScienceOldactivity = M('ScienceOldactivity');
    $result = $ScienceOldactivity -> field('title,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);

    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);

    $this -> display();
  }
}

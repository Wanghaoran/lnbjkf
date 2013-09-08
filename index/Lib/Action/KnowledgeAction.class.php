<?php
class KnowledgeAction extends CommonAction {
  public function publicknowledgecategory(){
    $public_category = M('KnowledgePublicknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $specialty_category = M('KnowledgeSpecialtyknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('public_category', $public_category);
    $this -> assign('specialty_category', $specialty_category);
    $where = array();
    if(!empty($_GET['cid'])){
      $where['a.cid'] = $this -> _get('cid');
    }
    import("ORG.Util.Page");// 导入分页类
    $count = M('KnowledgePublicknowledgearticle') -> alias('a') -> where($where) -> count('id');
    $page = new Page($count, 10);//每页10条
    $page->setConfig('header','条新闻');
    $show = $page -> show();
    $result = M('KnowledgePublicknowledgearticle') -> alias('a') -> field('a.id,a.title,c.name') -> join('laonian_knowledge_publicknowledgecategory as c ON a.cid = c.id') -> limit($page -> firstRow . ',' . $page -> listRows) -> where($where) -> order('a.addtime DESC') -> select();
    $this -> assign('result', $result);
    $this -> assign('show', $show);
    $this -> display();
  }

  public function specialtyknowledgecategory(){
    $public_category = M('KnowledgePublicknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $specialty_category = M('KnowledgeSpecialtyknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('public_category', $public_category);
    $this -> assign('specialty_category', $specialty_category);
    $where = array();
    if(!empty($_GET['cid'])){
      $where['a.cid'] = $this -> _get('cid');
    }
    import("ORG.Util.Page");// 导入分页类
    $count = M('KnowledgeSpecialtyknowledgearticle') -> alias('a') -> where($where) -> count('id');
    $page = new Page($count, 10);//每页10条
    $page->setConfig('header','条新闻');
    $show = $page -> show();
    $result = M('KnowledgeSpecialtyknowledgearticle') -> alias('a') -> field('a.id,a.title,c.name') -> join('laonian_knowledge_specialtyknowledgecategory as c ON a.cid = c.id') -> limit($page -> firstRow . ',' . $page -> listRows) -> where($where) -> order('a.addtime DESC') -> select();
    $this -> assign('result', $result);
    $this -> assign('show', $show);
    $this -> display();
  }

  public function specialtyknowledgecategoryinfo(){
    $KnowledgeSpecialtyknowledgearticle = M('KnowledgeSpecialtyknowledgearticle');
    $result = $KnowledgeSpecialtyknowledgearticle -> field('title,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $public_category = M('KnowledgePublicknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $specialty_category = M('KnowledgeSpecialtyknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('public_category', $public_category);
    $this -> assign('specialty_category', $specialty_category);
    $this -> display();
  }

  public function publicknowledgecategoryinfo(){
    $KnowledgePublicknowledgearticle = M('KnowledgePublicknowledgearticle');
    $result = $KnowledgePublicknowledgearticle -> field('title,content') -> find($this -> _get('id', 'intval'));
    $this -> assign('result', $result);
    $public_category = M('KnowledgePublicknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $specialty_category = M('KnowledgeSpecialtyknowledgecategory') -> field('id,name') -> order('sort ASC') -> select();
    $this -> assign('public_category', $public_category);
    $this -> assign('specialty_category', $specialty_category);
    $this -> display();
  }
}

<?php
class IndexAction extends CommonAction {
  public function index(){
    //最新动态
    $result_new = M('AboutDynamic') -> field('id,title,addtime,content') -> order('addtime DESC') -> limit(6) -> select();
    $this -> assign('result_new', $result_new);
    //学术园地
    $result_science = M('ScienceNowactivity') -> field('id,title') -> order('addtime DESC') -> limit(5) -> select();
    $this -> assign('result_science', $result_science);
    //大众科普
    $publicknowledge = M('KnowledgePublicknowledgearticle') -> field('id,title') -> order('addtime DESC') -> limit(5) -> select();
    $this -> assign('publicknowledge', $publicknowledge);
    //专业科普
    $specialtyknowledge = M('KnowledgeSpecialtyknowledgearticle') -> field('id,title') -> order('addtime DESC') -> limit(5) -> select();
    $this -> assign('specialtyknowledge', $specialtyknowledge);
    //图片幻灯
    $result_pic_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isindexpic=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isindexpic=1') -> buildSql();
    $result_pic = M() -> table($result_pic_sql . ' r') -> order('addtime DESC') -> limit(4) -> select();
    $this -> assign('result_pic', $result_pic);
    //科普知识
    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isindexleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isindexleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(7) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    //专家智库
    $result_expert = M('Expert') -> field('id,name') -> limit(25) -> order('addtime DESC') -> select();
    $this -> assign('result_expert', $result_expert);

    $this -> display();
  }
}

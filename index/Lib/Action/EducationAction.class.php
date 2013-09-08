<?php
class EducationAction extends CommonAction {

  public function content(){
    $Education = M('Education');
    $result = $Education -> getFieldByid('1', 'content');
    $this -> assign('result', $result);
    $result_knowledge_sql = M('KnowledgePublicknowledgearticle') -> field('id,pic,title,addtime,1+1 as type') -> where('isinsideleft=1') -> union('SELECT id,pic,title,addtime,1+2 as type FROM laonian_knowledge_specialtyknowledgearticle WHERE isinsideleft=1') -> buildSql();
    $result_knowledge = M() -> table($result_knowledge_sql . ' r') -> order('addtime DESC') -> limit(8) -> select();
    $this -> assign('result_knowledge', $result_knowledge);
    $this -> display();
  }
}

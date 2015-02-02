<?php
// Tag Class
Class TagAssoc {
    private $tableName = 'tags_assoc';

    // Create a Tag
    public function create($tagId, $articleId){
        $lab = new lelabDB();
        $query = "insert into $this->tableName (tag_id, article_id) values ('$tagId', '$articleId')";
        $result = $lab->execQuery($query);
        return $result;
    }

    // Check tag->article assoc
    public function checkAssoc($tagId, $articleId){
        $lab = new lelabDB();
        $query = "select * from $this->tableName where tag_id = '$tagId' and article_id = '$articleId'";
        $result = $lab->getArray($query);
        return $result;
    }

    // Delete a Tag
    public function delete($tagId, $articleId){
        $lab = new lelabDB();
        $query = "delete from $this->tableName where tag_id = '$tagId' and article_id = '$articleId'";
        $lab->execQuery($query);
    }

    // Delete by ID
    public function deleteByID($assocId){
        $lab = new lelabDB();
        $query = "delete from $this->tableName where id = '$assocId'";
        $lab->execQuery($query);
    }

    // Get article tags
    public function getArticleTags($articleId){
        $lab = new lelabDB();
        $query = "select * from $this->tableName where article_id = '$articleId'";
        $result = $lab->getArray($query);
        return $result;
    }

    // Get tag articles
    public function getTagArticles($tagId){
        $lab = new lelabDB();
        $query = "select * from $this->tableName where tag_id = '$tagId'";
        $result = $lab->getArray($query);
        return $result;
    }

}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/8/15
 * Time: 7:33 PM
 */

class TagModel extends BaseModel {

    public function getAllByPostId($postId) {
        $statement = self::$db->query(
            "SELECT t.tag
            FROM posts p
            LEFT JOIN posts_tags pt ON  p.id= pt.post_id
            LEFT JOIN tags t ON t.id=pt.tag_id
            WHERE post_id = $postId");
        return $statement->fetch_all(MYSQL_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM comments WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function saveTags($tags){
        for ($i = 0; $i < count($tags); $i++) {
            $statement = self::$db->prepare(
                "INSERT INTO `mvc_blog`.`tags` (`tag`) VALUES (?) ON DUPLICATE KEY UPDATE tag = tag;");
            $statement->bind_param("s", $tags[$i]);
            $statement->execute();
            if ($statement->affected_rows == 0 && $i<count($tags)-1) {
                continue;
            }
            return $statement->errno==0;
        }
    }

    public function bindTagsToPost($tags, $postId){
        $result = true;
        for ($i = 0; $i < count($tags); $i++) {
            $statement = self::$db->prepare(
                "SELECT id FROM tags WHERE tag = ?");
            $statement->bind_param("s", $tags[$i]);
            $statement->execute();
            $tagId = $statement->get_result()->fetch_assoc();
            $statement = self::$db->prepare(
                " INSERT INTO `mvc_blog`.`posts_tags` (`post_id`, `tag_id`) VALUES (?, ?) ON DUPLICATE KEY UPDATE post_id = post_id, tag_id = tag_id;");
            $statement->bind_param("ii", $postId, $tagId['id']);
            $statement->execute();
            if (!$statement->errno==0) {
                $result = false;
            }
        }
        return $result;
    }


    public function deleteTagFromPost($tagName, $post_id) {
        $statement = self::$db->prepare(
            "DELETE FROM `mvc_blog`.`posts_tags` WHERE tag_id = (SELECT id from `mvc_blog`.`tags` WHERE tag = ?) AND post_id = ? ");
        $statement->bind_param("si", $tagName, $post_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/7/15
 * Time: 11:22 PM
 */

class CommentModel extends BaseModel{
    public function getAllByPostId($postId) {
        $statement = self::$db->query("SELECT c.comment, c.post_id, c.date, u.username
        FROM comments as c
        INNER JOIN users as u
        ON c.user_id = u.id
        WHERE post_id = $postId");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM comments WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($text, $userId, $postId) {
        if ($text == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO comments VALUES(NULL ,?,?,?, NULL )");
        $statement->bind_param("sii", $text, $userId, $postId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
} 
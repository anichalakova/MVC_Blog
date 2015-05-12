<?php

class PostModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM posts");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllWithPaging($page, $pageSize) {
        $startIndex = ($page-1)*$pageSize;
        $statement = self::$db->prepare("SELECT * FROM posts LIMIT ? OFFSET ?");
        $statement->bind_param('ii', $pageSize, $startIndex);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM mvc_blog.posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($title, $text) {
        if ($text == '' || $title =='') {
            return false;
        }

        $statement = self::$db->prepare(
            "INSERT INTO posts VALUES(NULL ,?,?, NULL )");
        $statement->bind_param("ss", $title, $text);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $title, $text) {
        if ($text == '' || $title =='') {
            return false;
        }

        $statement = self::$db->prepare(
            "UPDATE posts SET title= ?, text =? WHERE id = ?");
        $statement->bind_param("ssi", $title, $text, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function findLast() {
        $statement = self::$db->query(
            "SELECT * FROM mvc_blog.posts ORDER BY `date` DESC LIMIT 1;");
        return $statement->fetch_assoc();
    }

    public function incrementVisits($id) {
        $statement = self::$db->query(
            "UPDATE `mvc_blog`.`posts` SET `visits`=`visits`+1 WHERE `id`=$id;");
        return $statement;
    }
} 
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
            "SELECT * FROM posts WHERE id = ?");
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
} 
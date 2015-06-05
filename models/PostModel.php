<?php

class PostModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query(
            "SELECT  id, title, text, posts.date, visits FROM posts");
        return $statement->fetch_assoc();
    }

    public function getAllWithPaging($page, $pageSize) {
        $startIndex = ($page-1)*$pageSize;

//        $results = array();
//        $statement = self::$db->prepare("SELECT id, title, text, posts.date, visits FROM posts LIMIT ? OFFSET ?");
//        $statement->bind_param('ii', $pageSize, $startIndex);
//        $statement->execute();
//        $id = '';
//        $title = '';
//        $text = '';
//        $date = '';
//        $visits = '';
//        $counter = 0;
//        $statement->bind_result($id, $title, $text, $date, $visits);
//
//        while ($statement->fetch()) {
//            $results[$counter] = array("id" => $id, "title" => $title, "text" => $text, "date" => $date, "visits" => $visits);
//            $counter++;
//        }
//        return $results;

//        Easier, but mysqlnd installed is required
        $statement = self::$db->prepare(
            "SELECT id, title, text, posts.date, visits FROM posts LIMIT ? OFFSET ?");
        $statement->bind_param('ii', $pageSize, $startIndex);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT  id, title, text, posts.date, visits FROM posts WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

//        $id = '';
//        $title = '';
//        $text = '';
//        $date = '';
//        $visits = '';
//        $statement->bind_result($id, $title, $text, $date, $visits);
//        $statement->fetch();
//        $result = array("id" => $id, "title" => $title, "text" => $text, "date" => $date, "visits" => $visits);
//        return $result;


//        Easier, but mysqlnd installed is required
        return $statement->get_result()->fetch_assoc();
    }

    public function findByTag($tag) {
        $statement = self::$db->prepare(
            "SELECT p.id, p.title, p.text, p.date, p.visits
            FROM posts p
            LEFT JOIN posts_tags pt ON  p.id= pt.post_id
            LEFT JOIN tags t ON t.id=pt.tag_id
            WHERE t.tag LIKE ?");
        $statement->bind_param('s', $tag);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function create($title, $text) {
        if ($text == '' || $title =='') {
            return false;
        }

        $statement = self::$db->prepare(
            "INSERT INTO posts VALUES(NULL ,?,?, NULL, 0 )");
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
            "SELECT  id, title, text, posts.date, visits FROM posts ORDER BY `date` DESC LIMIT 1;");
        return $statement->fetch_assoc();
    }

    public function incrementVisits($id) {
        $statement = self::$db->query(
            "UPDATE `posts` SET `visits`=`visits`+1 WHERE `id`=$id;");
        return $statement;
    }
}
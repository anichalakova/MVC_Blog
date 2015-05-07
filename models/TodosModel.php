<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/3/15
 * Time: 3:09 AM
 */

class TodosModel extends BaseModel{
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM todos");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllWithPaging($page, $pageSize) {
        $startIndex = ($page-1)*$pageSize;
        $statement = self::$db->prepare("SELECT * FROM todos LIMIT ? OFFSET ?");
        $statement->bind_param('ii', $pageSize, $startIndex);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM todos WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($todo_text) {
        if ($todo_text == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO todos VALUES(NULL ,?, NULL )");
        $statement->bind_param("s", $todo_text);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $todo_item) {
        if ($todo_item == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE todos SET todo_item = ? WHERE id = ?");
        $statement->bind_param("si", $todo_item, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM todos WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
} 
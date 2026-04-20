<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(ROOT_PATH . "app/database/connect.php");

if (!function_exists('executeQuery')) {
    function executeQuery($sql, $data = []) {
        global $conn;

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Błąd przygotowania zapytania SQL: " . $conn->error);
        }

        if (!empty($data)) {
            $types = '';
            $values = [];
            foreach ($data as $v) {
                $types .= is_int($v) ? 'i' : 's';
                $values[] = $v;
            }
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        return $stmt;
    }
}

if (!function_exists('selectAll')) {
    function selectAll($table, $conditions = []) {
        $sql = "SELECT * FROM $table";

        if (!empty($conditions)) {
            $i = 0; $values = [];
            foreach ($conditions as $key => $value) {
                $sql .= $i === 0 ? " WHERE $key=?" : " AND $key=?";
                $values[] = $value;
                $i++;
            }
            $stmt = executeQuery($sql, $values);
        } else {
            global $conn;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

if (!function_exists('selectOne')) {
    function selectOne($table, $conditions) {
        $results = selectAll($table, $conditions);
        return !empty($results) ? $results[0] : null;
    }
}

if (!function_exists('create')) {
    function create($table, $data) {
        $sql = "INSERT INTO $table SET ";
        $i = 0; $values = [];

        foreach ($data as $key => $value) {
            $sql .= ($i === 0 ? "" : ", ") . "$key=?";
            $values[] = $value;
            $i++;
        }

        $stmt = executeQuery($sql, $values);
        global $conn;
        return $conn->insert_id;
    }
}

if (!function_exists('update')) {
    function update($table, $id, $data) {
        $sql = "UPDATE $table SET ";
        $i = 0; $values = [];

        foreach ($data as $key => $value) {
            $sql .= ($i === 0 ? "" : ", ") . "$key=?";
            $values[] = $value;
            $i++;
        }

        $sql .= " WHERE id=?";
        $values[] = $id;

        $stmt = executeQuery($sql, $values);
        return $stmt->affected_rows;
    }
}

if (!function_exists('delete')) {
    function delete($table, $id) {
        $stmt = executeQuery("DELETE FROM $table WHERE id=?", [$id]);
        return $stmt->affected_rows;
    }
}

if (!function_exists('getPublishedPosts')) {
    function getPublishedPosts() {
        $sql = "SELECT p.*, u.username FROM posts AS p 
                JOIN users AS u ON p.user_id=u.id 
                WHERE p.published=?";
        $stmt = executeQuery($sql, [1]);
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

if (!function_exists('getPostsByTopicId')) {
    function getPostsByTopicId($topic_id) {
        $sql = "SELECT p.*, u.username FROM posts AS p 
                JOIN users AS u ON p.user_id=u.id 
                WHERE p.published=? AND topic_id=?";
        $stmt = executeQuery($sql, [1, $topic_id]);
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

if (!function_exists('searchPosts')) {
    function searchPosts($term) {
        $match = "%$term%";
        $sql = "SELECT p.*, u.username FROM posts AS p 
                JOIN users AS u ON p.user_id=u.id 
                WHERE p.published=? AND (p.title LIKE ? OR p.body LIKE ?)";
        $stmt = executeQuery($sql, [1, $match, $match]);
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
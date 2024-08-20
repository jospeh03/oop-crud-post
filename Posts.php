<?php

class Post {
    private $db;
    private $table = 'posts';

    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;
//making a constructer for the database
    public function __construct($db) {
        $this->db = $db;
    }

    public function create() {
    //preparted statment for creating 
        $sql = "INSERT INTO {$this->table} (title, content, author) VALUES (:title, :content, :author)";
        $statm = $this->db->prepare($sql);
        $statm->bindParam(':title', $this->title);
        $statm->bindParam(':content', $this->content);
        $statm->bindParam(':author', $this->author);
        return $statm->execute();
    }
//preprared statment for reading
    public function read($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $statm = $this->db->prepare($sql);
        $statm->bindParam(':id', $id);
        $statm->execute();
        return $statm->fetch(PDO::FETCH_ASSOC);
    }
//prepared statment for updating
    public function update() {
        $sql = "UPDATE {$this->table} SET title = :title, content = :content, author = :author, updated_at = NOW() WHERE id = :id";
        $statm = $this->db->prepare($sql);
        $statm->bindParam(':title', $this->title);
        $statm->bindParam(':content', $this->content);
        $statm->bindParam(':author', $this->author);
        $statm->bindParam(':id', $this->id);
        return $statm->execute();
    }
//prepared statement
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $statm = $this->db->prepare($sql);
        $statm->bindParam(':id', $id);
        return $statm->execute();
    }

    public function readAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $statm = $this->db->query($sql);
        return $statm->fetchAll(PDO::FETCH_ASSOC);
    }
}

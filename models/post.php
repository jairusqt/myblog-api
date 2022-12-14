<?php
class post {
    private $con;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db) {
        $this->con = $db;
    }

    public function read() {
        $query = 'SELECT   c.name as category_name,
                           p.id,
                           p.category_id,
                           p.title,
                           p.body,
                           p.author,
                           p.created_at
                           FROM
                           '.$this->table.' p
                           LEFT JOIN
                                category c ON p.category_id = c.id
                           ORDER BY
                            p.created_at DESC';
        $statement = $this->con->prepare($query);
        $statement ->execute();
        return $statement;       
    }

}
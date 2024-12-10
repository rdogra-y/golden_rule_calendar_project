<?php
namespace Models;

class Event {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new event
    public function createEvent($title, $description, $start_time, $end_time, $created_by, $image = null) {
        $stmt = $this->conn->prepare("INSERT INTO Events (title, description, start_time, end_time, created_by, image) 
                                      VALUES (:title, :description, :start_time, :end_time, :created_by, :image)");
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
            ':created_by' => $created_by,
            ':image' => $image
        ]);
    }

    // Fetch all events
    public function fetchAllEvents() {
        $stmt = $this->conn->prepare("SELECT * FROM Events ORDER BY start_time ASC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fetch event by ID
    public function fetchEventById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Events WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
?>

<?php

require '../config.php';
require '../model/rooms.php'; 

class roomcontroller
{

    public function listRooms()
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM rooms";
        try {
            $rooms = $db->query($sql);
            return $rooms;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteRoom($roomNumber)
{
    $sql = 'DELETE FROM rooms WHERE room_number = :roomNumber';
    $db = Config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(":roomNumber", $roomNumber);

    try {
        $req->execute();
    } catch (PDOException $e) {
        // Check if the exception is due to a foreign key constraint violation
        if ($e->getCode() == '23000' && strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
            // Redirect to a custom error page or display a user-friendly message
            header('Location: error.php');
            exit;
        } else {
            // For other types of exceptions, you might want to log the error
            die("Error:" . $e->getMessage());
        }
    }
}


    public function addRoom($room)
    {
        $sql = "INSERT INTO rooms  
        VALUES (:roomNumber, :status, :capacity, :pricePerNight)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'roomNumber' => $room->getRoomNumber(),
                'status' => $room->getStatus(),
                'pricePerNight' => $room->getPricePerNight(),
                'capacity' => $room->getCapacity(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showRoom($roomNumber)
    {
        $sql = "SELECT * FROM rooms WHERE room_number = :roomNumber";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(":roomNumber", $roomNumber);
            $query->execute();
            $room = $query->fetch();
            return $room;
        } catch (Exception $e) {
            // Log or handle the error appropriately
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateRoom($room, $roomNumber)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE rooms SET 
                    status = :status,
                    capacity = :capacity, 
                    price_per_night = :pricePerNight 
                WHERE room_number = :roomNumber'
            );

            $query->execute([
                'roomNumber' => $roomNumber,
                'status' => $room->getStatus(),
                'pricePerNight' => $room->getPricePerNight(),
                'capacity' => $room->getCapacity(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }




public function displaypatient($room_number) {
    try {
    $pdo = config::getConnexion();
    $query = $pdo->prepare("SELECT * FROM Patients WHERE room_number = :id");
    $query->execute(['id' => $room_number]);
    return $query->fetchAll();
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
    }
    
    public function displayroom() {
    try {
    $pdo = config::getConnexion();
    $query = $pdo->prepare("SELECT * FROM rooms");
    $query->execute();
    return $query->fetchAll();
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
    }



    public function orederRooms($choose, $start, $recordsPerPage)
    {
        $db = config::getConnexion();
        if ($choose == 1) {
            $sql = "SELECT * FROM rooms ORDER BY room_number LIMIT $start, $recordsPerPage";
        }

        if ($choose == 2) {
            $sql = "SELECT * FROM rooms ORDER BY price_per_night LIMIT $start, $recordsPerPage";
        }

        try {
            $rooms = $db->query($sql);
            return $rooms;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function filterAndOrderRooms($nstatus, $choose, $start, $recordsPerPage)
    {
        $db = config::getConnexion();

        $sql = "SELECT * FROM rooms WHERE status = ?";

        switch ($choose) {
            case 1:
                $sql .= " ORDER BY room_number";
                break;
            case 2:
                $sql .= " ORDER BY price_per_night";
                break;
            

            default:
               
                break;
        }

        $sql .= " LIMIT $start, $recordsPerPage";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $nstatus, PDO::PARAM_STR);
            $stmt->execute();
            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rooms;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function searchByCapacity($Capacity, $start, $recordsPerPage)
    {
        $db = config::getConnexion();

        $sql = "SELECT * FROM rooms WHERE capacity = :Capacity LIMIT $start, $recordsPerPage";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':Capacity', $Capacity, PDO::PARAM_INT);
            $stmt->execute();
            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rooms;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function filterRoomsBystatusAndcapacity($Capacity, $nstatus, $start, $recordsPerPage)
    {
        $db = config::getConnexion();

        $sql = "SELECT * FROM rooms WHERE Capacity = ?";

        if ($nstatus !== 'all') {
            $sql .= " AND status = ?";
        }

        $sql .= " LIMIT $start, $recordsPerPage";

        try {
            $stmt = $db->prepare($sql);

            if ($nstatus !== 'all') {
                $stmt->bindParam(1, $Capacity, PDO::PARAM_INT);
                $stmt->bindParam(2, $nstatus, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(1, $Capacity, PDO::PARAM_INT);
            }

            $stmt->execute();

            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rooms;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }




public function getFilteredTotalRecords($nstatus)
    {
        $db = config::getConnexion();

        $sql = "SELECT COUNT(*) as total FROM rooms";

        // If a specific diet type is provided, add a WHERE clause
        if ($nstatus !== 'all') {
            $sql .= " WHERE status = :nstatus";
        }

        try {
            $stmt = $db->prepare($sql);

            // Bind parameter if a specific diet type is provided
            if ($nstatus !== 'all') {
                $stmt->bindParam(':nstatus', $nstatus, PDO::PARAM_STR);
            }

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $row['total'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function getTotalRecords()
    {
        $db = config::getConnexion();
        $sql = "SELECT COUNT(*) as total FROM rooms";

        try {
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $row['total'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


}
?>

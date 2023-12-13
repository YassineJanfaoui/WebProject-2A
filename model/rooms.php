<?php

class rooms {
    private int $room_number;
    private string $status;
    private int $price_per_night;
    private int $capacity;

    public function __construct(int $room_number, string $status, int $price_per_night,  int $capacity) {
        $this->room_number = $room_number;
        $this->status = $status;
        $this->price_per_night = $price_per_night;
        $this->capacity = $capacity;
    }

    public function getRoomNumber(): int {
        return $this->room_number;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getPricePerNight(): int {
        return $this->price_per_night;
    }


    public function getCapacity(): string {
        return $this->capacity;
    }

}
?>

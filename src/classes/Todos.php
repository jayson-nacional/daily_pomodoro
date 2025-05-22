<?php

namespace JaysonNacional\DailyPomodoro\classes;

use Cassandra\Date;
use JaysonNacional\DailyPomodoro\interfaces\ICrudable;

class Todos implements ICrudable
{
    private int $id;
    private string $name;
    private Date $date;
    private int $sequenceNumber;

    public function __construct(
        int $id,
        string $name,
        Date $date,
        int $sequenceNumber
    ) {
        $this->$id = $id;
        $this->$name = $name;
        $this->$date = $date;
        $this->$sequenceNumber = $sequenceNumber;
    }

    public function create(): int
    {
        echo "Create Todos has been called";
        return 1;
    }

    public function update(): void
    {
        echo "Update Todos has been called";
    }

    public function delete(): void
    {
        echo "Delete Todos has been called";
    }
}

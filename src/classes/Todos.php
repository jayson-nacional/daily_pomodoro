<?php

namespace JaysonNacional\DailyPomodoro\classes;

use Cassandra\Date;
use JaysonNacional\DailyPomodoro\interfaces\ICrudable;

class Todos implements ICrudable
{
    public int $id;
    public string $name;
    public Date $date;
    public int $sequenceNumber;

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

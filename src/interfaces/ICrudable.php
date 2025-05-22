<?php

namespace JaysonNacional\DailyPomodoro\interfaces;

interface ICrudable
{
    public function create(): int;
    public function update(): void;
    public function delete(): void;
}

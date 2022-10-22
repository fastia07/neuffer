<?php

interface LoggerInterface
{
    public function write(string $data);

    public function close();
}

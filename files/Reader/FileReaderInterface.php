<?php

interface FileReaderInterface
{
    public function validate();

    public function read();

    public function close();
}

<?php

class DB
{
    public function connect()
    {
        try {
            global $config;
            $conn = mysqli_connect(
                $config['LOCALHOST'],
                $config['USERNAME'],
                $config['PASSWORD'],
                $config['DATABASE'],
                $config['PORT'],
            );
            $conn->set_charset("utf8");
            return $conn;
        } catch (\Throwable $th) {
            die("Kết nối database thất bại.");
        }
    }
}

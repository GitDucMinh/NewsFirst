<?php
    class DB {
        private $servername = "localhost",
                $username = "root",
                $password = "",
                $database = "db_news";
        
        public $conn = NULL;

        public function connect() {
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        }

        public function close() {
            if($this->conn) {
                mysqli_close($this->conn);
            }
        }

        public function query($sql = null) {
            if($this->conn) {
                mysqli_query($this->conn, $sql);
            }
        }

        public function num_rows($sql = null) {
            if($this->conn) {
                $query = mysqli_query($this->conn, $sql);
                if($query) {
                    $row = mysqli_num_rows($query);
                    return $row;
                }
            }
        }

        // public function fetch_assoc($sql = null, $type)
        // {
        //     if ($this->conn)
        //     {
        //         $query = mysqli_query($this->conn, $sql);
        //         if ($query)
        //         {
        //             if ($type == 0)
        //             {
        //                 // Lấy nhiều dữ liệu gán vào mảng
        //                 while ($row = mysqli_fetch_assoc($query))
        //                 {
        //                     $data[] = $row;
        //                 }
        //                 return $data;
        //             }
        //             else if ($type == 1)
        //             {
        //                 // Lấy một hàng dữ liệu gán vào biến
        //                 $data = mysqli_fetch_assoc($query);
        //                 return $data;
        //             }
        //         }       
        //     }
        // }
 

        public function insert_id() {
            if($this->conn) {
                $count = mysqli_insert_id($this->conn);
                if($count == '0') {
                    $count = '1';
                } else {
                    $count = $count;
                }
                return $count;
            }
        }

        public function set_char($uni) {
            if($this->conn) {
                mysqli_set_charset($this->conn, $uni);
            }
        }
    }
?>
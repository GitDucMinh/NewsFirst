<?php
   Class Session {
    public function start() {
        session_start();
    }

    public function send($user) {
        $_SESSION['email'] = $user;
    }

    public function get() {
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        } else {
            $user = '';
        }
        
        return $user;
    }

    public function destroy() {
        session_destroy();
    }
   }
?>
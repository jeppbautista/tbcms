<?php
    class ContactMailer{
        public $to;
        public $from;
        public $subject;
        private $header;
        public $message;

        public function __construct(){
            $this->message = "";
            $this->from = "TBCMerchantServices<automail@tbcmerchantservices.com>";
            $this->to = "tbcmservices@gmail.com";
        }

        public function sendMail(){
            $this->header = "From:" . $this->from. "\r\n";
            $this->header .= "Content-Type: text/html; charset=UTF-8\r\n";
            mail($this->to, $this->subject, $this->message, $this->header);
        }

    }

?>
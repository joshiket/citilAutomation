<?php
    Class Logger
    {
        private $file;

        public function __construct()
        {
            $this->file = "log.txt";
        }

        public function log ($txt)
        {
            $f = fopen( $this->file, "a" );
            fwrite($f,$txt);
            fclose($f);
        }
    }
?>
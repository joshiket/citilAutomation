<?php
                if(isset($_SESSION['lgUser']))
                {
                unset($_SESSION['lgUser']);
                }
                header("location: ../");
?>
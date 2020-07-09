<?php
$Phone = "+919722275786" ;
$connection = mysqli_connect("localhost", "id12585906_adil", "Adil9444", "id12585906_tapin");
						if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
				}
               $stmt = $connection->prepare("SELECT User_Id FROM `USER_NEW`  WHERE Phone= ? ;");
                $stmt->bind_param("s",$Phone);
               if( $stmt->execute())
               {
                $stmt->bind_result($result);
                echo $result;
               }
                ?>
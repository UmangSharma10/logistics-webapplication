<?php

    class GetOrder{
        private $con;
        public $orderList=array();
        function __construct(){
            
            require_once dirname(__FILE__).'/DbConnect.php';
            $db = new DbConnection();
            $this->con = $db->connect();
        }
       
        
        public    function getOrder($Phone){
            $orderList=array();
		$connection = mysqli_connect("localhost", "id12585906_adil", "Adil9444", "id12585906_tapin");
						if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
				}
               $stmt = $this->con->prepare("SELECT User_Id FROM `USER_NEW`  WHERE Phone= ? ;");
                $stmt->bind_param("s",$Phone);
               
                if($stmt->execute())
                {
                   $stmt->bind_result($User_Id);
                   $sql="SELECT * FROM ORDERS WHERE User_Id=".$User_Id;
                    //$result = $this->con->query($sql);
                    if($result = $connection->query($sql))
                    {
                        if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
				    
						$temp = array();
						$temp['Order_Id'] = $row["Order_Id"]; 
						$temp['Weight'] = $row["Weight"]; 
						$temp['Description'] = $row["Description"]; 
						$temp['Description'] = $row["Order_Status"];
                        $temp['Receiver_Name'] = $row["Receiver_Name"];
                        $temp['Receiver_Phone'] = $row["Receiver_Phone"];
                        $temp['Receiver_Address'] = $row["Receiver_Address"];
						array_push($orderList, $temp);
												}
								}
                    }
               
                }
                else
                {
                    //$details['msg']="2";
                    return $orderList;
                }
           
                   return $orderList;

              
        }
    }
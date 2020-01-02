<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <div>
        <div id="main-form">

            <div class="part">

                <img src="images/envelop.jpg" alt="envelop">

            </div>
            <div class="part">
                <div id="divForm">
                    <form action="form.php" method="GET">
                        <div class="input-in">

                            <input type="text" name="fname" placeholder="First Name">
                        </div>
                        <div class="input-in">

                            <input type="text" name="lname" placeholder="Last Name">
                        </div>
                        <div class="input">

                            <input type="radio" name="gender" value="Male" checked><label>Male</label>
                            <input type="radio" name="gender" value="Femal"><label>Female</label>
                            <input type="radio" name="gender" value="Other"><label>Other</label>


                        </div>
                        <div class="input-in">
                            <input type="date" name="dob" placeholder="Date of Birth" >
                        </div>
                        <div class="input-in">
                            <input type="text" name="email" placeholder="Email">
                        </div>
                        <div class="input-in">
                            <input type="text" name="pass" placeholder="Password">
                        </div>
                        <div class="sub">
                            <button>Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   <!-- <div id="divTable">
        <table>
            <tr>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Gender</th>
                <th>DateOfBirth</th>
                <th>Email</th>
                <th>Pass</th>
            </tr>
        </table>
    </div>-->



</body>

</html>


<?php
    require_once('./file/file.php');

    $file = 'user_info.txt';
    
    $obj = new info();
    $fopen = $obj->openFile($file,"a+");

    $obj->writeFile($fopen,$_GET);
    

   

    $pattern1 = " ";
    $pattern2 = "::";
    $arr = $obj->readFile($fopen,$pattern1);

    fclose($fopen);
    

    $arrSec = $obj->explodeSec($arr,$pattern2);
   
        for ($i=0; $i < count($arrSec) ; $i++) { 
            # code...
            $obj = new info();
             
            //////////// Get value from key name of array $tempName2 ///////////////
            //////////// Assign value to each data member of Object ///////////////
            
                $obj->FirstName = $arrSec[$i]['FirstName']; 
                $obj->LastName = $arrSec[$i]['LastName'];
                $obj->Gender = $arrSec[$i]['Gender'];
                $obj->DateOFBirth = $arrSec[$i]['DateOFBirth'];
                $obj->Email = $arrSec[$i]['Email'];
                $obj->Password = $arrSec[$i]['Password'];
            
           
            
     
         //////////////////////// Addding Object -- Array /////////////////////////////
            $arrObj[$i] = $obj;
        }
   
    
    //print_r($arrObj);
    createTable($arrObj)
    
?>
<link rel="stylesheet" href="form.css">
<div id="H">
    <form action="ex.php" method="" class ="divtable">
                <div id="divImg"><img src="pf1.png" alt="pf" type ="file"></div>
                <div class="m"><label>First-Name : </label><input type="text" name="fname" id="fname"></div>
                <div class="m"><label>Last-Name : </label><input type="text" name="lname" id="lname"></div>
                <div class="m"><label>Gender : </label>
                    <select name="gender" id="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="m"><label>Date-of-birth : </label><input type="date" id="date" name="dob" value="2019-07-22" min="1900-01-01" max="2019-12-31"></div>
                <button type="submit" id="add">Submit</button>
                <button type="button" id="show">Show</button>
    </form>
</div>

<?php

    class info
    {
        public $FirstName;
        public $LastName;
        public $Gender;
        public $DateOFBirth;
    }

    $file = 'user_info.txt';
    $fopen = fopen($file,'a+');

    /* if($fopen == false){
        echo ('Error in openning new file');
        exit();
    }
    
    if(false !=isset($_GET['fname'])){
        fwrite($fopen , "FirstName::".$_GET['fname']." ".
                        "LastName::".$_GET['lname']." ".
                        "Gender::".$_GET['gender']." ".
                        "DateOFBirth::".$_GET['dob']."\n");
    } */

    ///////////////////////////////// READ FILE //////////////////////////////////////
    //echo fread($fopen,filesize('user_info.txt'));

    $pattern1 = " ";
    $pattern2 = "::";
    
    $tempName = [];
    $i = 0;
    while(!feof($fopen)){

       ///////////////////// fgets() is read single character ///////////////////////
      $tempName[$i] = explode($pattern1,fgets($fopen));
      $i++;
      
    }
    
    /////////////////       Explode to associate Array      ////////////////////
    for ($i=0; $i <count($tempName) ; $i++) { 
       
        foreach ($tempName[$i] as $value) {
            # code...
            $tempIm = explode($pattern2,$value);

        ////////////////////// Define key Name and Value of Array $tempIm /////////////////////////
        //////////////////////             Assign to  $tempName2          /////////////////////////
           $tempName2[$i][$tempIm[0]] = $tempIm[1]; 
        }
    }
    
   for ($i=0; $i < count($tempName2) ; $i++) { 
       # code...
       $obj = new info();
        
       //////////// Get value from key name of array $tempName2 ///////////////
       //////////// Assign value to each data member of Object //////////////
       $obj->FirstName = $tempName2[$i]['FirstName']; 
       $obj->LastName = $tempName2[$i]['LastName'];
       $obj->Gender = $tempName2[$i]['Gender'];
       $obj->DateOFBirth = $tempName2[$i]['DateOFBirth'];

    //////////////////////// Addding Object -- Array /////////////////////////////
       $arrObj[$i] = $obj;
   }
    ///////////////////////////// ADD data to Table ////////////////////////////
   $tempTh = array();
   $tempTd = array();
   echo "<table border = '1'>";
        for ($i=0; $i <count($arrObj) ; $i++) { 
            # code...
            echo "<tr>";
            foreach ($arrObj[$i] as $key => $value) {
                # code...
                if(0 == $i){
                    array_push($tempTh,$key);
                    array_push($tempTd,$value);
                }else{
                    echo "<td>".$value."</td>";
                }
            }
            echo "</tr>";
            if(0 == $i){
                echo "<tr>";
                foreach ($tempTh as $value) {
                    # code...
                    echo "<th>".$value."</th>";
                }
                echo "</tr>";
                echo "<tr>";
                foreach ($tempTd as $value) {
                    # code...
                    echo "<td>".$value."</td>";
                }
                echo "</tr>";
            }
        }

   echo "</table>"; 
  

    fclose($fopen);
?>

<?php

    class info
    {
        public $FirstName;
        public $LastName;
        public $Gender;
        public $DateOFBirth;
        public $Email;
        public $Password;
    
        
        function openFile($fileName,$type){
            $fileOpen = fopen($fileName,$type);

            if($fileOpen == false){
                die("Error openning new file!");
            }
            
            return $fileOpen;
        }

        function writeFile($fileOpen,$Get_Values_From_Form){
            if(isset($Get_Values_From_Form['fname']) && isset($Get_Values_From_Form['lname']) &&
                isset($Get_Values_From_Form['gender']) && isset($Get_Values_From_Form['dob']) &&
                isset($Get_Values_From_Form['email']) && isset($Get_Values_From_Form['pass']))
            {
                if("" == $Get_Values_From_Form['fname'] || "" == $Get_Values_From_Form['lname'] ||
                    "" == $Get_Values_From_Form['email'] || "" == $Get_Values_From_Form['pass'])
                {
                    die('You have to fill blank property! ');
                }else{
                        fwrite($fileOpen,"FirstName::".$Get_Values_From_Form['fname']." ".
                    "LastName::".$Get_Values_From_Form['lname']." ".
                    "Gender::".$Get_Values_From_Form['gender']." ".
                    "DateOFBirth::".$Get_Values_From_Form['dob']." ".
                    "Email::".$Get_Values_From_Form['email']." ".
                    "Password::".$Get_Values_From_Form['pass']."\n");
                }
            }
           
        }

        // functin Read file 
        // explode file being read
        // assign to array
        // return array
        function readFile($fileOpen,$pattern1){
            $arr = array();
            $i = 0;
            
            while(!feof($fileOpen)){
                
                $arr[$i] = explode($pattern1,fgets($fileOpen));
                $i++;
            
            }
            
            return $arr;
        }

        function explodeSec($arr,$pattern2){
            for ($i=0; $i <count($arr) ; $i++) { 
        
                foreach ($arr[$i] as $value) {
                    # code...
                    $tempIm = explode($pattern2,$value);
        
                    ////////////////////////  The way how to fix Undefined offset: 1   //////////////////
                    if ( ! isset($tempIm[1])) {
                        $tempIm[1] = null;
                    }
                    ////////////////////// Define key Name and Value of Array $tempIm /////////////////////////
                    //////////////////////             Assign to  $arr1          /////////////////////////
                    
                    $arr1[$i][$tempIm[0]] = $tempIm[1]; 
                }
            }
            return $arr1;
        }  
       
    }


    function createTable($arrObj){
          
        $tempTh = array();
        $tempTd = array();
        echo "<table border = '1'>";
        for ($i = 0; $i <count($arrObj) ; $i++) { 
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
    }


?>
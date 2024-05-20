<?php

class Crud{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "threewmadone";
    private $conn; // MySQLi connection object
    private $id;

    public function __construct()
    {
        // Open db connection
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        //echo "Connected successfully";
    }
    public function __destruct()
    {
        // Close db connection
        if ($this->conn) {
            $this->conn->close();
            //echo "Connection closed";
        }
    }
    protected function viewAll()
    {
       $sql_query = mysqli_query($this->conn,"SELECT * FROM student") or die('Query Error');
       while($row = mysqli_fetch_object($sql_query))
       {
          echo $row->firstname."<br/>";
       }

    }
    protected  function viewSpecific($id)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"SELECT * FROM student WHERE id='$this->id' LIMIT 1") or die('Query Error');
       $row = mysqli_fetch_object($sql_query);
       echo $row->id." ".$row->firstname." ".$row->lastname;
    }
    protected  function delete($id)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"DELETE FROM student WHERE id='$this->id'") or die('Query Error');
       echo "Record removed";
    }
    protected  function update($id,$firstname,$lastname,$course)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"UPDATE student SET 
        firstname='$firstname', 
        lastname ='$lastname',
        course = '$course'
        WHERE id='$this->id'") or die('Query Error');
       echo "Record changed";
    }
    protected  function insert($id,$firstname,$lastname,$course)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"INSERT INTO student(id,firstname,lastname,course) VALUES
       ($id,'$firstname','$lastname','$course')") or die('Query Error');
       echo "Record added";
    }
    protected  function search($firstname)
    {   
       $sql = "SELECT * FROM student WHERE firstname LIKE '%".$firstname."%' ";
       $sql_query = mysqli_query($this->conn,$sql) or die('Query Error');
       echo "Results :".mysqli_num_rows($sql_query)."<hr/>";
       while($row = mysqli_fetch_object($sql_query))
       {
         if($row){
         echo $row->id." ".$row->firstname." ".$row->lastname."<br/>";}
         else{
            echo "No record found!";
         }
      }
    }
}

class Transaction extends Crud{
   public function doTrans($operation,$value)
   {
      if($operation == 'hanap')
      {
         $this->search($value);
      }
      else if($operation == 'hanapIsa'){
         $this->viewSpecific($value); 
      }
   }
}


// $transaction = new Transaction();
// $transaction->doTrans("hanapIsa",1);
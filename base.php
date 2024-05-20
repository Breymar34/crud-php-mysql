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

    public function viewAll()
    {
       $sql_query = mysqli_query($this->conn,"SELECT * FROM student") or die('Query Error');
       while($row = mysqli_fetch_object($sql_query))
       {
          echo $row->firstname."<br/>";
       }

    }

    public function viewSpecific($id)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"SELECT * FROM student WHERE id='$this->id' LIMIT 1") or die('Query Error');
       $row = mysqli_fetch_object($sql_query);
       echo $row->id." ".$row->firstname." ".$row->lastname;
    }

    public function delete($id)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"DELETE FROM student WHERE id='$this->id'") or die('Query Error');
       echo "Record removed";
    }
    public function update($id,$firstname,$lastname,$course)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"UPDATE student SET 
        firstname='$firstname', 
        lastname ='$lastname',
        course = '$course'
        WHERE id='$this->id'") or die('Query Error');
       echo "Record changed";
    }
    public function insert($id,$firstname,$lastname,$course)
    {  
       $this->id = $id; 
       $sql_query = mysqli_query($this->conn,"INSERT INTO student(id,firstname,lastname,course) VALUES
       ($id,'$firstname','$lastname','$course')") or die('Query Error');
       echo "Record added";
    }
    public function search($firstname)
    {   
       $sql_query = mysqli_query($this->conn,"SELECT * FROM student WHERE firstname LIKE '%K%'") or die('Query Error');
       $row = mysqli_fetch_object($sql_query);
       echo $row->id." ".$row->firstname." ".$row->lastname;
    }
}


$crud = new Crud();
//$crud->viewAll();
//$crud->viewSpecific(2);
//$crud->delete(2);
//$crud->update(1,'James','Saint','BSIT');
//$crud->insert(4,'Naye','Saint','BSCS');
$crud->search('K');
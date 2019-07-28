<?php

class Employee {

    // External DB Objects
    private $conn;
    private $table = "employee";
    

    // Dealing with Post and Get Requests.

    public $id;
    public $empname;
    public $salary;
    public $mobile;

    /**
     * C - Create
     * R - Read
     * U - Update
     * D - Delete
     *  
     * */


    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {

       $query = 'SELECT * FROM EMPLOYEE';

        // Preparing the Statement

        $stmt = $this->conn->prepare($query);

        // Executing the Statement

        $stmt->execute();

        return $stmt;

    }

    // For fetching the single user Data

    public function read_single_user_data() {
        
       $id = $_GET['emp_id'];

       $query = "SELECT * FROM employee where emp_id = '".$id."' ";

        // Preparing the Statement

        $stmt = $this->conn->prepare($query);

        // Executing the Statement

        $stmt->execute();

        return $stmt;

    }
    
    
    
    // Creating a new Record
    public function create() {

        $query = 'INSERT INTO employee SET 
        emp_id = :id,
        emp_name = :empname,
        emp_salary = :salary,
        emp_mobile = :mobile';

        // insert into table_name values(valu1, val2, val3,....);

        // Preparing the Statment

        $stmt = $this->conn->prepare($query);

        // Cleaning the data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->empname = htmlspecialchars(strip_tags($this->empname));
        $this->salary = htmlspecialchars(strip_tags($this->salary));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));


        // Bind Data

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':empname', $this->empname);
        $stmt->bindParam(':salary', $this->salary);
        $stmt->bindParam(':mobile', $this->mobile);

        // Execution of Statement
     
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n",$stmt->error);

        return false;
    }

    // Updating the Record

    public function update() {

        $query = 'UPDATE employee SET 
        emp_salary = :salary
        WHERE
        emp_id = :id';

        // Preparing the Statement

        $stmt =  $this->conn->prepare($query);

        // Cleaning the data

        $this->salary = htmlspecialchars(strip_tags($this->salary));

        // Binding the Data
        $stmt->bindParam(':salary', $this->salary);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            return true;
        }

        printf("Error: %s.\n",$stmt->error);

        return false;

    }

    // Deleting the Record

    public function delete() {

        $query = "DELETE FROM employee where emp_id = :id";

        // Preparing the Statement

        $stmt = $this->conn->prepare($query);

        //  Cleaning the Data

        $this->id = htmlspecialchars(strip_tags($this->id));

        // Binding the Data

        $stmt->bindParam(':id', $this->id);

        // Executing the Statement

        if($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n",$stmt->error);

        return false;
    }

}

?>
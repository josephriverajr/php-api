<?php
  Class Post{
  	private $conn;
  	 private $table = 'news';
  

	  public $id;
	  public $name;
	  public $age;

	  public function __construct($db){
	  	$this->conn=$db;
	  }

	  //queries
	  public function read(){
	  	$query = 'SELECT * FROM '.$this->table.' where content_type="News" order by id desc';
	    $stmt = $this->conn->prepare($query);

		  $stmt->execute();
	
		  return $stmt;
	  }

	  //queries
	  //single post
	  public function read_single(){
	  	$query = 'SELECT * 
  				  FROM '.$this->table.' 
  				  WHERE content_type="News" and id = ?';
  		$stmt = $this->conn->prepare($query);
  		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->title = $row['title'];
		$this->desc = $row['desc'];

	  }

	  public function create(){
	  	$query = 'INSERT INTO '.$this->table.' 
	  			SET title = :title, content_type = :content_type, created_at = NOW()';

		$stmt = $this->conn->prepare($query);

		$this->title =htmlspecialchars(strip_tags($this->title));
		// $this->desc =htmlspecialchars(strip_tags($this->desc));
		$stmt->bindParam(':title',$this->title);
		// $stmt->bindParam(':desc',$this->desc);
		$stmt->bindParam(':content_type',$this->content_type);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
			return false;
		
	  }

	public function update(){
	  	$query = 'UPDATE  '.$this->table.' 
	  			SET title = :title, content_type = :content_type, created_at = NOW(), updated_at = Now() 
	  			WHERE id = :id';

		$stmt = $this->conn->prepare($query);

		$this->title =htmlspecialchars(strip_tags($this->title));
		$this->id =htmlspecialchars(strip_tags($this->id));
		$stmt->bindParam(':title',$this->title);
		$stmt->bindParam(':id',$this->id);
		$stmt->bindParam(':content_type',$this->content_type);

		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
			return false;
		
  	}
	public function delete(){
		$query ='DELETE FROM  '.$this->table.' WHERE id = :id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
			return false;
		
	}

	}
?>
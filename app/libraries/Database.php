<?php 
	/*
	-	mysqli DB class
	-	connect to database
	- Ovde samo dosta eksperimentisao neki od ovih metoda su sa stack ovreflow, neki su sa githuba, sve sam manje ili vise prepravio na ovaj ili onaj nacin kako bi sluzili ovoj svrsi. Klasa koju sam ja na samom pocetku napravio bila je suvise jednostavna, tako da sam kako su se povecavale potrebe MVC-a dodavao metode. To je proces koji jos uvek traje i trenutno razradjujem mogucnost prikazivanja gresaka koje se mogu dogoditi u komunikaciji sa bazom, a plan je da se svaka greska loguje i sacuva u bazi, a zatim prikaze adminu u backendu kada je ulogovan.
	
	*/
	class Database{
		private $host = DB_HOST;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $db_name = DB_NAME;		
		
		private $link = null;	

	    public static $counter = 0;

		



		public function __construct() {
	        mb_internal_encoding( 'UTF-8' );
	        mb_regex_encoding( 'UTF-8' );
	        mysqli_report( MYSQLI_REPORT_STRICT );
	        try {
	            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
	            $this->link->set_charset( "utf8" );
	        } catch ( Exception $e ) {
	            die( 'Unable to connect to database' );
	        }
	    }

        public function __destruct(){
	        if( $this->link){
	            $this->disconnect();
	        }
	    }

	    public function clear($query){
	    	$res = $this->link->real_escape_string($query);
	    	return $res;
	    }	 	

		public function query( $query ){
	        $full_query = $this->link->query( $query );
	        if( $this->link->error ){	           
	            return false; 
	        } else {
	            return true;
	        }
	    }

	    public function table_exists( $name ){
		    self::$counter++;
		    $check = $this->link->query( "SELECT 1 FROM $name" );
		    if($check !== false){
		        if( $check->num_rows > 0 ){
		            return true;
		        } else {
		            return false;
		        }
		    } else {
		        return false;
		    }
		}

		public function num_rows( $query ){
	        self::$counter++;
	        $num_rows = $this->link->query( $query );
	        
	        return $num_rows->num_rows;	        
	    }	    

    	public function get_row( $query, $object = false ){
	        self::$counter++;
	        $row = $this->link->query( $query );
	        if( $this->link->error ){	           
	            return false;
	        } else {
	            $r = ( !$object ) ? $row->fetch_row() : $row->fetch_object();
	            return $r;   
	        }
	    }  

	    public function get_results( $query, $object = false ){
	        self::$counter++;	        
	        $row = null;
	        
	        $results = $this->link->query( $query );
	        if( $this->link->error ){	            
	            return false;
	        } else {
	            $row = array();
	            while( $r = ( !$object ) ? $results->fetch_assoc() : $results->fetch_object() ){
	                $row[] = $r;
	            }
	            return $row;   
	        }
	    }  
	    
	    public function lastid(){
	        self::$counter++;
	        return $this->link->insert_id;
	    }

	    public function num_fields( $query ){
	        self::$counter++;
	        $query = $this->link->query( $query );
	        $fields = $query->field_count;
	        return $fields;
	    }

	    public function list_fields( $query ){
	        self::$counter++;
	        $query = $this->link->query( $query );
	        $listed_fields = $query->fetch_fields();
	        return $listed_fields;
	    }   

	    public function disconnect(){
	        $this->link->close();
	    }		
	}
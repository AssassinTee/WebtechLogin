 <?php
 class Database {
   /**
    * instance
    *
    * Statische Variable, um die aktuelle (einzige!) Instanz dieser Klasse zu halten
    *
    * @var Singleton
    */
   protected static $_instance = null;
   protected static $_username = 'root';
   protected static $_password = 'geheim';
   protected static $_name = 'mysql:host=localhost;dbname=internettechdb';
 
   /**
    * get instance
    *
    * Falls die einzige Instanz noch nicht existiert, erstelle sie
    * Gebe die einzige Instanz dann zurück
    *
    * @return   Singleton
    */
   public static function getInstance()
   {
       if (null === self::$_instance)
       {
           self::$_instance = new PDO(self::$_name, self::$_username, self::$_password);
       }
       return self::$_instance;
   }
 
   public static function regUser($username, $password, $note)
   {
        $sql = "INSERT INTO user(username, password, note) VALUES (:username, :password, :note)";
        try {
            $dbase = Database::getInstance();
            $stmt = $dbase->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);       
            $stmt->bindParam(':password', $password, PDO::PARAM_STR); 
            $stmt->bindParam(':note', $note, PDO::PARAM_INT);
            $stmt->execute();
        //print_r($stmt->errorInfo());
        } catch (PDOException $e) {
            if ($e->getCode() == 1062) {
                return 1;
            } 
            else {    
                return 2;
            }
        }
        return 0;
   }
   
   public static function validateUserpass($username, $password)
   {
        $sql = "SELECT username, password FROM user WHERE username = :username";
        try {
            $dbase = Database::getInstance();
            $stmt = $dbase->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);        
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count === 1) {
                //TODO: do Session
                $data = $stmt->fetch();
                $hash = $data["password"];
                if(crypt($password, $hash) == $hash) {
                    return 0;
                }
                return 1;//Wrong password or username
            }
            else if($count === 0) {
                return 1;//not known username
            }
            
        } catch (PDOException $e) {}
        return 2;//multiple username error, this should not happen
   }

   /**
    * clone
    *
    * Kopieren der Instanz von aussen ebenfalls verbieten
    */
   protected function __clone() {}
   
   /**
    * constructor
    *
    * externe Instanzierung verbieten
    */
   protected function __construct() {}
 }
 ?>


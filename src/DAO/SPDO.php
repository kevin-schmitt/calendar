<?php
namespace APP\DAO;
class SPDO
{
  /**
   * Instance of PDO class
   *
   * @var PDO
   * @access private
   */
  private $PDOInstance = null;

   /**
   * Instance of PDO class
   *
   * @var SPDO
   * @access private
   * @static
   */
  private static $instance = null;

  /**
   * Constant: user name for connexion
   *
   * @var string
   */
  const DEFAULT_SQL_USER = 'root';

  /**
   * Constant: hôte of database
   *
   * @var string
   */
  const DEFAULT_SQL_HOST = 'localhost';

  /**
   * Constant: pass of database
   *
   * @var string
   */
  const DEFAULT_SQL_PASS = '';

  /**
   * Constant: database name
   *
   * @var string
   */
  const DEFAULT_SQL_DTB = 'calendar';

  /**
   * Constructor
   *
   * @param void
   * @return void
   * @see PDO::__construct()
   * @access private
   */
  private function __construct()
  {
    $this->PDOInstance = new \PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);
  }

   /**
    * Make and return instance of object
    *
    * @access public
    * @static
    * @param void
    * @return SPDO $instance
    */
  public static function getInstance()
  {
    if(is_null(self::$instance))
    {
      self::$instance = new SPDO();
    }
    return self::$instance;
  }

  /**
   * Execute sql request
   *
   * @param string $query of sql request
   * @return PDOStatement return object PDOStatement
   */
  public function query($query)
  {
    return   $this->PDOInstance->query($query);
  }
}

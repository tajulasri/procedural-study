<?php
#require_once '../bootstrap.php';

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{

    /**
     * @var mixed
     */
    private $config;

    public function setUp()
    {
        //we will fix this hack line sometime later.
        $this->config = [

            'database' => [
                'pdo'    => [
                    'host'          => $_ENV['DATABASE_HOST'],
                    'database_name' => $_ENV['DATABASE_NAME'],
                    'username'      => $_ENV['DATABASE_USER'],
                    'password'      => $_ENV['DATABASE_PASS'],
                ],
                'mysqli' => [
                    'host'          => $_ENV['DATABASE_HOST'],
                    'database_name' => $_ENV['DATABASE_NAME'],
                    'username'      => $_ENV['DATABASE_USER'],
                    'password'      => $_ENV['DATABASE_PASS'],
                ],
            ],
        ];

    }

    public function test_app_path()
    {
        $currentDir = explode('/', __DIR__);
        $removeLast = array_splice($currentDir, -1);
        $this->assertEquals(implode('/', $currentDir), app_path());
    }

    public function test_config_path()
    {
        $currentDir = explode('/', __DIR__);
        $currentDir[count($currentDir) - 1] = 'config';

        $this->assertEquals(implode('/', $currentDir), config_path());
    }

    public function test_lib_path()
    {
        $currentDir = explode('/', __DIR__);
        $currentDir[count($currentDir) - 1] = 'libs';

        $this->assertEquals(implode('/', $currentDir), lib_path());
    }

    public function test_service_path()
    {
        $currentDir = explode('/', __DIR__);
        $currentDir[count($currentDir) - 1] = 'services';

        $this->assertEquals(implode('/', $currentDir), service_path());
    }

    public function test_spin_environment()
    {
        $environment = 'local';
        $this->assertEquals($environment, environment());
    }

    public function test_boostrapping_logging()
    {
        create_file_log(environment());
        $this->assertFileExists(logging_path(environment() . '.log'));
        @unlink(logging_path(environment() . '.log'));
    }

    //database driver test section
    public function test_bootstrapping_mysqli_driver()
    {
        $databaseDriverResolver = database_driver_resolver('mysqli', $this->config['database']['mysqli']);
        $this->assertInstanceOf(Mysqli::class, $databaseDriverResolver);
    }

    public function test_bootstrapping_pdo_driver()
    {
        $databaseDriverResolver = database_driver_resolver('pdo', $this->config['database']['pdo']);
        $this->assertInstanceOf(PDO::class, $databaseDriverResolver);
    }

    public function test_boostrapping_repository_by_driver()
    {
        //by default we supply mysqli as fallback driver
        //to see fail assertion please change driver mysqli | PDO

        $driver = 'mysqli';
        $this->assertArraySubset(['loaded_repository' => $driver], database_repository_resolver($driver));
        //below assertion should fail caused of there is not driver name sample
        $this->assertFalse(database_repository_resolver('sample'));
    }

    public function test_get_database_connection_on_boot()
    {
        //default driver is mysql
        //to demostrate false assertion
        //change config to "pdo" driver
        $this->assertInstanceOf(Mysqli::class, get_db_connection());
        $this->assertNotInstanceOf(PDO::class, get_db_connection());
    }

    //session driver test section

    //router session test section

}

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

    //session driver test section

    //router session test section

}

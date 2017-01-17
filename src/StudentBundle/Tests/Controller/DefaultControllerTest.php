<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 17.01.17
 * Time: 18:55
 */

namespace StudentsBundle\Tests\Controller;
use StudentBundle\Controller\DefaultController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestDefaultController extends WebTestCase
{
    public function testStudentAction()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/student/lula_moore');
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(DefaultController::CACHE_TIME, $response->getMaxAge());
    }
}
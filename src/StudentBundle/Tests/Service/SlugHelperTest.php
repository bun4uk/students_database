<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 17.01.17
 * Time: 19:04
 */

namespace StudentBundle\Tests\Service;

use StudentBundle\Service\SlugHelper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SlugHelperTest extends WebTestCase
{

    public function nameSlugDataProvider()
    {
        return [
            ['fake name', 'fake_name'],
            ['Volodymyr Bunchuk', 'volodymyr_bunchuk'],
            ['234_FeWd', '_fewd'],
            ['','']
        ];
    }

    /**
     * @param $name
     * @param $expected
     *
     * @dataProvider nameSlugDataProvider
     */
    public function testGenerateSlug($name, $expected)
    {
        $slugHelperMock = new SlugHelper();

        $result = $slugHelperMock->generateSlug($name);

        $this->assertEquals($expected, $result);
    }

    public function testDuplicates()
    {
        $name = 'Volodymyr Bunchuk';
        $slugHelperMock = new SlugHelper();

        $result = $slugHelperMock->generateSlug($name);
        $this->assertEquals('volodymyr_bunchuk', $result);

        $result = $slugHelperMock->generateSlug($name);
        $this->assertEquals('volodymyr_bunchuk_2', $result);
    }

}
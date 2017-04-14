<?php
/**
 * This file is part of the Apk Parser package.
 *
 * (c) Evozi <email@evozi.com>
 * (c) Fred Cox <fred@ekreative.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class XmlParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException ApkParser\Exceptions\XmlParserException
     */
    public function testXmlObject()
    {
        $mock = $this->getMockBuilder('ApkParser\XmlParser')
            ->disableOriginalConstructor()
            ->setMethods(array('getXmlString'))
            ->getMock();

        $file = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'invalid.xml';
        $mock->expects($this->once())->method('getXmlString')->will($this->returnValue(file_get_contents($file)));

        $mock->getXmlObject();
    }
}
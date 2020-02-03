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
class ManifestTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @throws \ApkParser\Exceptions\XmlParserException
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \PHPUnit\Framework\MockObject\RuntimeException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testMetaData()
    {
        $mock = $this->getMockBuilder('ApkParser\XmlParser')
            ->disableOriginalConstructor()
            ->setMethods(array('getXmlString'))
            ->getMock();

        $file = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'meta.xml';
        $mock->expects($this->once())->method('getXmlString')->will($this->returnValue(file_get_contents($file)));

        $manifest = new \ApkParser\Manifest($mock);

        $this->assertEquals('0x7f0c0012', $manifest->getMetaData('com.google.android.gms.version'));
    }
}
<?php

namespace ApkParser;

/**
 * This file is part of the Apk Parser package.
 *
 * (c) Tufan Baris Yildirim <tufanbarisyildirim@gmail.com>
 * (c) Evozi <email@evozi.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Manifest extends Xml
{

    private $xmlParser;
    private $attrs = null;
    private $meta = null;

    /**
     * @param XmlParser $xmlParser
     */
    public function __construct(XmlParser $xmlParser)
    {
        $this->xmlParser = $xmlParser;
    }

    /**
     * @return Application
     * @throws Exceptions\XmlParserException
     */
    public function getApplication()
    {
        return $this->getXmlObject()->getApplication();
    }

    /**
     * Returns ManifestXml as a String.
     * @return string
     * @throws \Exception
     */
    public function getXmlString()
    {
        return $this->xmlParser->getXmlString();
    }

    /**
     * Get Application Permissions
     * @param string $lang
     * @return array
     * @throws Exceptions\XmlParserException
     */
    public function getPermissions($lang = 'en')
    {
        return $this->getXmlObject()->getPermissions($lang);
    }

    /**
     * Android Package Name
     * @return string
     * @throws \Exception
     */
    public function getPackageName()
    {
        return $this->getAttribute('package');
    }

    /**
     * Application Version Name
     * @return string
     * @throws \Exception
     */
    public function getVersionName()
    {
        return $this->getAttribute('versionName');
    }

    /**
     * Application Version Code
     * @return mixed
     * @throws \Exception
     */
    public function getVersionCode()
    {
        return hexdec($this->getAttribute('versionCode'));
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isDebuggable()
    {
        return (bool)$this->getAttribute('debuggable');
    }

    /**
     * The minimum API Level required for the application to run.
     * @return int
     * @throws Exceptions\XmlParserException
     */
    public function getMinSdkLevel()
    {
        $xmlObj = $this->getXmlObject();
        $usesSdk = get_object_vars($xmlObj->{'uses-sdk'});
        return hexdec($usesSdk['@attributes']['minSdkVersion']);
    }

    /**
     * @param $attributeName
     * @return mixed
     * @throws \Exception
     */
    private function getAttribute($attributeName)
    {
        if ($this->attrs === null) {
            $xmlObj = $this->getXmlObject();
            $vars = get_object_vars($xmlObj->attributes());
            $this->attrs = $vars['@attributes'];
        }

        if (!isset($this->attrs[$attributeName]))
            throw new \Exception("Attribute not found : " . $attributeName);

        return $this->attrs[$attributeName];
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exceptions\XmlParserException
     */
    public function getMetaData($name)
    {
        if ($this->meta === null) {
            $xmlObj = $this->getXmlObject();
            $nodes = $xmlObj->xpath('//meta-data');
            $this->meta = array();
            foreach ($nodes as $node) {
                $nodeAttrs = get_object_vars($node->attributes());
                $nodeName = $nodeAttrs['@attributes']['name'];
                if (array_key_exists('value', $nodeAttrs['@attributes'])) {
                    $this->meta[$nodeName] = $nodeAttrs['@attributes']['value'];
                } elseif (array_key_exists('resource', $nodeAttrs['@attributes'])) {
                    $this->meta[$nodeName] = $nodeAttrs['@attributes']['resource'];
                }
            }
        }
        return $this->meta[$name];
    }

    /**
     * More Information About The minimum API Level required for the application to run.
     * @return AndroidPlatform
     * @throws \Exception
     */
    public function getMinSdk()
    {
        return new AndroidPlatform($this->getMinSdkLevel());
    }

    /**
     * More Information About The target API Level required for the application to run.
     * @return AndroidPlatform
     * @throws \Exception
     */
    public function getTargetSdk()
    {
        if ($this->getTargetSdkLevel()) return new AndroidPlatform($this->getTargetSdkLevel());
        return null;
    }

    /**
     * The target API Level required for the application to run.
     * @return float|int
     * @throws Exceptions\XmlParserException
     */
    public function getTargetSdkLevel()
    {
        $xmlObj = $this->getXmlObject();
        $usesSdk = get_object_vars($xmlObj->{'uses-sdk'});
        if (hexdec($usesSdk['@attributes']['targetSdkVersion'])) return hexdec($usesSdk['@attributes']['targetSdkVersion']);
        return null;
    }

    /**
     * get SimleXmlElement created from AndroidManifest.xml
     *
     * @param mixed $className
     * @return ManifestXmlElement|\SimpleXMLElement
     * @throws Exceptions\XmlParserException
     */
    public function getXmlObject($className = '\ApkParser\ManifestXmlElement')
    {
        return $this->xmlParser->getXmlObject($className);
    }

    /**
     * Basically string casting method.
     * @throws \Exception
     */
    public function __toString()
    {
        return $this->getXmlString();
    }
}
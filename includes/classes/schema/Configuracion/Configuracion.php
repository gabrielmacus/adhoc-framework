<?php

class Configuracion
{
    protected $language;
    protected $dataSource;
    protected $tokenSecret;
    protected $version;
    protected $siteFolder;
    protected $siteAddress;
    protected $jsCdn;
    protected $cssCdn;
    protected $siteName;
    protected $comanyName;
    /**
     * Configuracion constructor.
     * @param $language
     * @param $tokenSecret
     * @param $version
     * @param $folderName
     * @param $siteAddress
     * @param $jsCdn
     * @param $cssCdn
     * @param $siteName
     */
    public function __construct( $dbHost, $dbUser, $dbPass, $dbName, $tokenSecret,
                                 $version, $siteAddress,$siteName,$companyName,
                                 $folderName=null, $jsCdn=null, $cssCdn=null,$language="es")
    {
        $this->language = $language;
        $this->dataSource=new DataSource($dbUser,$dbPass,$dbHost,$dbName);
        
        $this->tokenSecret = $tokenSecret;
        $this->version = $version;
        $this->siteFolder = $folderName;
        $this->siteAddress = $siteAddress;
        $this->jsCdn = $jsCdn;
        $this->cssCdn = $cssCdn;
        $this->siteName=$siteName;
        $this->comanyName=$companyName;
    }

    /**
     * @return mixed
     */
    public function getComanyName()
    {
        return $this->comanyName;
    }

    /**
     * @param mixed $comanyName
     */
    public function setComanyName($comanyName)
    {
        $this->comanyName = $comanyName;
    }

    

    /**
     * @return mixed
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * @param mixed $siteName
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;
    }




    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return DataSource
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param DataSource $dataSource
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
    }

  

    /**
     * @return mixed
     */
    public function getTokenSecret()
    {
        return $this->tokenSecret;
    }

    /**
     * @param mixed $tokenSecret
     */
    public function setTokenSecret($tokenSecret)
    {
        $this->tokenSecret = $tokenSecret;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getSiteFolder()
    {
        return $this->siteFolder;
    }

    /**
     * @param mixed $siteFolder
     */
    public function setSiteFolder($siteFolder)
    {
        $this->siteFolder = $siteFolder;
    }

    /**
     * @return mixed
     */
    public function getSiteAddress()
    {
        return $this->siteAddress;
    }

    /**
     * @param mixed $siteAddress
     */
    public function setSiteAddress($siteAddress)
    {
        $this->siteAddress = $siteAddress;
    }

    /**
     * @return mixed
     */
    public function getJsCdn()
    {
        return $this->jsCdn;
    }

    /**
     * @param mixed $jsCdn
     */
    public function setJsCdn($jsCdn)
    {
        $this->jsCdn = $jsCdn;
    }

    /**
     * @return mixed
     */
    public function getCssCdn()
    {
        return $this->cssCdn;
    }

    /**
     * @param mixed $cssCdn
     */
    public function setCssCdn($cssCdn)
    {
        $this->cssCdn = $cssCdn;
    }
    
    
}
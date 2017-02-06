<?php
/**
 * Created by IntelliJ IDEA.
 * User: dylanaird
 * Date: 2/12/16
 * Time: 11:06 PM
 */

namespace BankStatement\Models\BankStatements\Response;


class Institution
{


    private $slug;

    private $name;

    /*
     * @var InstitutionsCredentials
     * */
    private $credentials = [];


    private $status;

    private $searchable;

    private $display;
    private $searchVal;
    private $region;
    private $export_with_password;
    private $estatements_supported;
    private $transactions_listings_supported;
    private $requires_preload;
    private $requires_mfa;
    private $updated_at;
    private $max_days;

    /**
     * Institutions constructor.
     */
    public function __construct(){}

    /**
     * @param null $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param null $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param array|null $credentials
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param null $searchable
     */
    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;
    }

    /**
     * @param null $display
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }

    /**
     * @param null $searchVal
     */
    public function setSearchVal($searchVal)
    {
        $this->searchVal = $searchVal;
    }

    /**
     * @param null $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @param null $export_with_password
     */
    public function setExportWithPassword($export_with_password)
    {
        $this->export_with_password = $export_with_password;
    }

    /**
     * @param null $estatements_supported
     */
    public function setEstatementsSupported($estatements_supported)
    {
        $this->estatements_supported = $estatements_supported;
    }

    /**
     * @param null $transactions_listings_supported
     */
    public function setTransactionsListingsSupported($transactions_listings_supported)
    {
        $this->transactions_listings_supported = $transactions_listings_supported;
    }

    /**
     * @param null $requires_preload
     */
    public function setRequiresPreload($requires_preload)
    {
        $this->requires_preload = $requires_preload;
    }

    /**
     * @param null $requires_mfa
     */
    public function setRequiresMfa($requires_mfa)
    {
        $this->requires_mfa = $requires_mfa;
    }

    /**
     * @param null $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @param null $max_days
     */
    public function setMaxDays($max_days)
    {
        $this->max_days = $max_days;
    }


    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getSearchable()
    {
        return $this->searchable;
    }

    /**
     * @return mixed
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @return mixed
     */
    public function getSearchVal()
    {
        return $this->searchVal;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return mixed
     */
    public function getExportWithPassword()
    {
        return $this->export_with_password;
    }

    /**
     * @return mixed
     */
    public function getEstatementsSupported()
    {
        return $this->estatements_supported;
    }

    /**
     * @return mixed
     */
    public function getTransactionsListingsSupported()
    {
        return $this->transactions_listings_supported;
    }

    /**
     * @return mixed
     */
    public function getRequiresPreload()
    {
        return $this->requires_preload;
    }

    /**
     * @return mixed
     */
    public function getRequiresMfa()
    {
        return $this->requires_mfa;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return mixed
     */
    public function getMaxDays()
    {
        return $this->max_days;
    }


}
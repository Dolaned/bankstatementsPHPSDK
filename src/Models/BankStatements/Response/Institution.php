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
     * @param $slug
     * @param $name
     * @param $credentials
     * @param $status
     * @param $searchable
     * @param $display
     * @param $searchVal
     * @param $region
     * @param $export_with_password
     * @param $estatements_supported
     * @param $transactions_listings_supported
     * @param $requires_preload
     * @param $requires_mfa
     * @param $updated_at
     * @param $max_days
     */
    public function __construct($slug = null, $name = null, $credentials = null, $status = null, $searchable = null, $display = null, $searchVal = null, $region = null, $export_with_password = null, $estatements_supported = null, $transactions_listings_supported = null, $requires_preload = null, $requires_mfa = null, $updated_at = null, $max_days = null)
    {
        $this->slug = $slug;
        $this->name = $name;
        $this->credentials = $credentials;
        $this->status = $status;
        $this->searchable = $searchable;
        $this->display = $display;
        $this->searchVal = $searchVal;
        $this->region = $region;
        $this->export_with_password = $export_with_password;
        $this->estatements_supported = $estatements_supported;
        $this->transactions_listings_supported = $transactions_listings_supported;
        $this->requires_preload = $requires_preload;
        $this->requires_mfa = $requires_mfa;
        $this->updated_at = $updated_at;
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
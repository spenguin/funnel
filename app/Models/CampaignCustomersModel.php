<?php



namespace App\Models;



use CodeIgniter\Model;



class CampaignCustomersModel extends Model
{
    protected $table = 'campaign_customers';

    protected $allowedFields = ['customer_id', 'campaign_id', 'paid', 'campaign_email_sent', 'campaign_email_sent_date'];

    /**
     * Get Customers by Campaign Email Id, and date
     * Return array
     */
    public function getCustomersByEmailTypeAndDateGrouped($emailTypeId = NULL, $delay = NULL )
    {
        if( is_null($emailTypeId) ) return [];
        if( is_null($delay) ) return [];
        $date = date( "Y-m-d H:i:s", strtotime("-" . $delay . "day")); //die($date);

        return $this->where(['campaign_email_sent' => $emailTypeId, 'campaign_email_sent_date <=' => $date])
            ->groupBy('campaign_id')
            ->findAll();

    }

}
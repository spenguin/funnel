<?php



namespace App\Models;



use CodeIgniter\Model;



class CampaignEmailsModel extends Model

{

    protected $table = 'campaign_emails';



    protected $allowedFields = ['email_type_id', 'campaign_id'];

    public function getEmail($id = null)
    {
        if (is_null($id)) 
        {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }



    public function getCampaignEmail($campaignId = NULL, $emailTypeId = NULL)
    {
        if (is_null($campaignId) || is_null($emailTypeId) ) {
            return NULL;
        }

        return $this->where(['campaign_id' => $campaignId, 'email_type_id' => $emailTypeId])->first();
    }      

}
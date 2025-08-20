<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    // protected $primaryKey       = 'id';

    // protected $useAutoIncrement = true;

    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = true;

    protected $allowedFields    = ['name', 'username', 'email', 'pwhash', 'nonce'];

    /**
     *  Validate the user. If TRUE, add user data  Session variables
     *  @return TRUE or FALSE
     */
	// public function validate()
	// {	die('test');
    //     return TRUE;
    // }
// 		$this->load->library( 'encryption' );
//         $this->db->where( 'username', $this->input->post( 'username' ) ); 
// 		$query	= $this->db->get( $this->_table );
// 		if( $query->num_rows() > 0 )
// 		{	
// 			foreach( $query->result_array()  as $row )
// 			{	
// 				if( $this->input->post('password') == $this->encryption->decrypt( $row['pwhash'] ) )
//                 {	
// 					$this->session->set_userdata(array(
// 								'id'		=> $row['id'],
// 								'username'		=> $row['username'],
// //								'level'		=> $row['level'],
//                     ));
                    
// /*					$this->db->where( 'id', $row['id']);
// 					$this->db->update( self::DataTable, array(
// 											'lastLogin'	=> $row['thisLogin'],
// 											'thisLogin'	=> time()
// 					));*/
// 					return TRUE;
// 				}
// 			}
// 		}
// 		return FALSE;
// 	}    
}
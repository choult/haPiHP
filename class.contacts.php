<?php
/**
 * Copyright 2012 HubSpot, Inc.
 *
 *   Licensed under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.
 *   You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 * either express or implied.  See the License for the specific
 * language governing permissions and limitations under the
 * License.
 */
require_once('class.baseclient.php');

/**
 * @author Christopher Hoult <chris.hoult@datasift.com>
 * @see https://github.com/chrishoult
 */
class HubSpot_Contacts extends HubSpot_BaseClient {
    //Client for HubSpot Contacts API.

    //Define required client variables
    protected $API_PATH = 'contacts';
    protected $API_VERSION = 'v1';

	/**
	 * Get a contact by its email address
	 *
	 * @param email: String value of the email for the contact to return
	 *
	 * @returns single Contact as stdObject
	 *
	 * @throws HubSpot_Exception
     **/
    public function get_contact_by_email($email) {
        $endpoint = 'contact/email/' . $email . '/profile';
        try {
            $contactArray = json_decode('[' . $this->execute_get_request($this->get_request_url($endpoint, array())) . ']');
            return (is_array($contactArray) && count($contactArray)) ? $contactArray : false;
        } catch (HubSpot_Exception $e) {
            throw new HubSpot_Exception('Unable to retrieve contact: ' . $e);
        }
    }

	/**
	 * Updates a contact
	 *
	 * @param integer $vid
	 * @param An array of properies $properties
	 *
	 * @return boolean
	 *
	 * @throws HubSpot_Exception
	 */
	public function update_contact($vid, $properties)
	{
		$endpoint = 'contact/vid/' . $vid . '/profile';
		try {
            return $this->execute_post_request($this->get_request_url($endpoint,null), json_encode($properties));
        } catch (HubSpot_Exception $e) {
            throw new HubSpot_Exception('Unable to retrieve contact: ' . $e);
        }
	}

}
<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

	/**
	 * Class constructor
	 *
	 * @link	https://github.com/bcit-ci/CodeIgniter/issues/5332
	 * @return	void
	 */
	public function __construct() {}

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}
  
  public function splitColumn($text) {
    $splitString = explode('.', $text);
    return $splitString[count($splitString)-1];
  }
  
  function setColumnNext() {
    $column['ActiveDate'] = 'ActiveDate';
    $column['Address'] = 'Address';
    $column['AddReward'] = 'AddReward';
    $column['Bank'] = 'Bank';
    $column['BankAccountName'] = 'BankAccountName';
    $column['BankName'] = 'BankName';
    $column['BankNumber'] = 'BankNumber';
    $column['BigCity'] = 'BigCity';
    $column['Birthday'] = 'Birthday';
    $column['Brand'] = 'Brand';
    $column['BrandName'] = 'BrandName';
    $column['CheckoutDate'] = 'CheckoutDate';
    $column['CHTime'] = 'CHTime';
    $column['CHusr'] = 'CHusr';
    $column['City'] = 'City';
    $column['ClaimReward'] = 'ClaimReward';
    $column['Code'] = 'Code';
    $column['CreateDate'] = 'CreateDate';
    $column['CreateUser'] = 'CreateUser';
    $column['Date'] = 'Date';
    $column['Date_'] = 'Date_';
    $column['Day_'] = 'Day_';
    $column['Description'] = 'Description';
    $column['DownPayment'] = 'DownPayment';
    $column['Email'] = 'Email';
    $column['EmailToken'] = 'EmailToken';
    $column['EntryDate'] = 'EntryDate';
    $column['EntryUser'] = 'EntryUser';
    $column['ExpiredDate'] = 'ExpiredDate';
    $column['Export'] = 'Export';
    $column['Facebook'] = 'Facebook';
    $column['FacilitiesID'] = 'FacilitiesID';
    $column['FirstName'] = 'FirstName';
    $column['Gender'] = 'Gender';
    $column['Group_'] = 'Group_';
    $column['HourDuration'] = 'HourDuration';
    $column['HP'] = 'HP';
    $column['Icon'] = 'Icon';
    $column['ID'] = 'ID';
    $column['IDPayment'] = 'IDPayment';
    $column['Instagram'] = 'Instagram';
    $column['Inventory'] = 'Inventory';
    $column['Invoice'] = 'Invoice';
    $column['IsPhoneVerified'] = 'IsPhoneVerified';
    $column['IsVerified'] = 'IsVerified';
    $column['LastName'] = 'LastName';
    $column['LinkName'] = 'LinkName';
    $column['Member'] = 'Member';
    $column['MemberID'] = 'MemberID';
    $column['MemberType'] = 'MemberType';
    $column['MinuteDuration'] = 'MinuteDuration';
    $column['Name'] = 'Name';
    $column['Name_'] = 'Name_';
    $column['NameOutlet'] = 'NameOutlet';
    $column['NextOTPAttempt'] = 'NextOTPAttempt';
    $column['Note'] = 'Note';
    $column['OldMemberID'] = 'OldMemberID';
    $column['Outlet'] = 'Outlet';
    $column['OutletAdd'] = 'OutletAdd';
    $column['OutletKlaim'] = 'OutletKlaim';
    $column['OutletLat'] = 'OutletLat';
    $column['OutletLong'] = 'OutletLong';
    $column['OutletMapDesc'] = 'OutletMapDesc';
    $column['Overpax'] = 'Overpax';
    $column['Password'] = 'Password';
    $column['PasswordResetToken'] = 'PasswordResetToken';
    $column['PayDate'] = 'PayDate';
    $column['PhoneOTP'] = 'PhoneOTP';
    $column['Photo'] = 'Photo';
    $column['Point'] = 'Point';
    $column['Point_'] = 'Point_';
    $column['PointUse'] = 'PointUse';
    $column['Posted'] = 'Posted';
    $column['Price'] = 'Price';
    $column['Qty'] = 'Qty';
    $column['Reception'] = 'Reception';
    $column['ReconfirmationHour'] = 'ReconfirmationHour';
    $column['ReconfirmationNote'] = 'ReconfirmationNote';
    $column['RegisterDate'] = 'RegisterDate';
    $column['Religion'] = 'Religion';
    $column['RememberToken'] = 'RememberToken';
    $column['Reservation'] = 'Reservation';
    $column['ReservationDate'] = 'ReservationDate';
    $column['Room'] = 'Room';
    $column['RoomType'] = 'RoomType';
    $column['RoomTypeName'] = 'RoomTypeName';
    $column['SalesOrder'] = 'SalesOrder';
    $column['Service'] = 'Service';
    $column['Shift'] = 'Shift';
    $column['Status'] = 'Status';
    $column['Status_'] = 'Status_';
    $column['Stock'] = 'Stock';
    $column['Tax'] = 'Tax';
    $column['Telepon'] = 'Telepon';
    $column['Telp'] = 'Telp';
    $column['TimeFinish'] = 'TimeFinish';
    $column['TimeStart'] = 'TimeStart';
    $column['Title'] = 'Title';
    $column['TotalPoin'] = 'TotalPoin';
    $column['Total'] = 'Total';
    $column['TransactionDate'] = 'TransactionDate';
    $column['Type_'] = 'Type_';
    $column['TypeFacility'] = 'TypeFacility';
    $column['Unit'] = 'Unit';
    $column['URL'] = 'URL';
    $column['UserID'] = 'UserID';
    $column['UserName'] = 'UserName';
    $column['InventoryID_Global'] = 'InventoryID_Global';
    $column['MaxPoint'] = 'MaxPoint';
    $column['MaxVisit'] = 'MaxVisit';
    $column['Order_'] = 'Order_';
    $column['DiscRoom'] = 'DiscRoom';
    $column['DiscFnB'] = 'DiscFnB';
    $column['Color'] = 'Color';
    $column['Summary'] = 'Summary';
    $column['RatingProduct'] = 'RatingProduct';
    $column['RatingService'] = 'RatingService';
    $column['RatingPrice'] = 'RatingPrice';
    $column['StatusTrash'] = 'StatusTrash';
    $column['Value_'] = 'Value_';
    $column['Pay_Value'] = 'Pay_Value';
    
    return $column;
  }

}

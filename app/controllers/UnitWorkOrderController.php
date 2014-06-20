<?php 

use Iwo\Validation\UnitWorkOrderValidator;

class UnitWorkOrderController extends BaseController
{
	// Instance of validator
	protected $validator;
	// Keyword for this Work Order form
	protected $iwo_key = 'unit';
	// Form type label
	protected $iwo_key_label = "Units/Affiliates/Correspondents";
	// Fields in the form that should be hidden from the confirmation screen
	protected $hidden_from_user = ['_token'];
	// The subject line for emails
	protected $email_subject = 'Units / Correspondents / Affiliates Internal Work Order Submission';

	public function __construct(UnitWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
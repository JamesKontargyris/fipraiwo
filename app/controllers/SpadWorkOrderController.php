<?php 

use Iwo\Validation\SpadWorkOrderValidator;

class SpadWorkOrderController extends BaseController
{
	// Instance of validator
	protected $validator;
	// Keyword for this Work Order form
	protected $iwo_key = 'spad';
	// Fields in the form that should be hidden from the confirmation screen
	protected $hidden_from_user = ['_token'];
	// The subject line for emails
	protected $email_subject = 'Special Adviser Internal Work Order Submission';

	public function __construct(SpadWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
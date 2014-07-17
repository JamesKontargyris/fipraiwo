<?php

use Iwo\Validation\EDTWorkOrderValidator;

class EDTWorkOrderController extends BaseController
{
	// Instance of validator
	protected $validator;
	// Keyword for this Work Order form
	protected $iwo_key = 'edt';
	// Form type label
	protected $iwo_key_label = "EDT";
	// Fields in the form that should be hidden from the confirmation screen
	protected $hidden_from_user = ['_token', 'max_upload_size'];
	// The subject line for emails
	protected $email_subject = 'EDT Internal Work Order Submission';
    // Array of views to be sent to each email recipient
    protected $email_views = [
        'lead-unit' => 'edt.edt',
        'copies' => 'default'
    ];

	public function __construct(EDTWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
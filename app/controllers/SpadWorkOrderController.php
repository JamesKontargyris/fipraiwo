<?php 

use Iwo\Validation\SpadWorkOrderValidator;

class SpadWorkOrderController extends BaseController
{
	// Instance of validator
	protected $validator;
	// Keyword for this Work Order form
	protected $iwo_key = 'spad';
	// Form type label
	protected $iwo_key_label = "Special Adviser";
	// Fields in the form that should be hidden from the confirmation screen
	protected $hidden_from_user = ['_token'];
	// The subject line for emails
	protected $email_subject = 'Special Adviser Internal Work Order Submission';
    // Array of views to be sent to each email recipient
    protected $email_views = [
        'lead' => 'spad.account-director',
        'sub' => 'spad.spad',
        'copies' => 'default'
    ];
    //Default confirmed state for this IWO type
    protected $confirmed = 0;

    public function __construct(SpadWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
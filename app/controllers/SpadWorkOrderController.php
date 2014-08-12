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
	public static $hidden_from_user = ['_token'];
	// The subject line for emails
	protected $email_subject = 'Special Adviser Internal Work Order Submission';
    //Array of form field names to use as user names in the DB
    protected $user_names = [
        'lead' => 'account_director',
        'sub' => 'special_adviser',
    ];
    //Default confirmed state for this IWO type
    protected $confirmed = 0;

    public function __construct(SpadWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}

    public function getCheck()
    {
        return View::make('spadcheck')->with('page_title', 'Special Adviser Internal Work Order');
    }
}
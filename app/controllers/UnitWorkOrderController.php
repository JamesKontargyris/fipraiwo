<?php 

use Iwo\Validation\UnitWorkOrderValidator;

class UnitWorkOrderController extends BaseController
{
	// Instance of validator
	protected $validator;
	// Keyword for this Work Order form
	protected $iwo_key = 'unit';
	// Form type label
	protected $iwo_key_label = "Fipra Unit";
	// Fields in the form that should be hidden from the confirmation screen
	protected $hidden_from_user = ['_token', 'person-count'];
	// The subject line for emails
	protected $email_subject = 'Fipra Unit Internal Work Order Submission';
    // Array of views to be sent to each email recipient
    protected $email_views = [
        'lead' => 'unit.lead-unit',
        'sub' => 'unit.sub-unit',
        'copies' => 'default'
    ];
    //Array of form field names to use as user names in the DB
    protected $user_names = [
        'lead' => 'lead_unit_account_director',
        'sub' => 'sub_contracted_unit_correspondent_affiliate_account_director'
    ];
    //Default confirmed state for this IWO type
    protected $confirmed = 0;

	public function __construct(UnitWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
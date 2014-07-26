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
        'lead-unit' => 'unit.lead-unit',
        'sub-unit' => 'unit.sub-unit',
        'copies' => 'default'
    ];

	public function __construct(UnitWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
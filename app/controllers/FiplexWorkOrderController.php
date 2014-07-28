<?php 

use Iwo\Validation\FiplexWorkOrderValidator;

class FiplexWorkOrderController extends BaseController
{
	// Instance of validator
	protected $validator;
	// Keyword for this Work Order form
	protected $iwo_key = 'fiplex';
	// Form type label
	protected $iwo_key_label = "Fiplex";
	// Fields in the form that should be hidden from the confirmation screen
	protected $hidden_from_user = ['_token', 'max_upload_size'];
	// The subject line for emails
	protected $email_subject = 'Fiplex Internal Work Order Submission';
    // Array of views to be sent to each email recipient
    protected $email_views = [
        'lead' => 'fiplex.fiplex',
        'copies' => 'default'
    ];
    //Default confirmed state for this IWO type
    protected $confirmed = 1;

	public function __construct(FiplexWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
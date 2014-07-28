<?php 

use Iwo\Validation\FiptalkWorkOrderValidator;

class FiptalkWorkOrderController extends BaseController
{
	// Instance of validator
	protected $validator;
	// Keyword for this Work Order form
	protected $iwo_key = 'fiptalk';
	// Form type label
	protected $iwo_key_label = "Fiptalk";
	// Fields in the form that should be hidden from the confirmation screen
	protected $hidden_from_user = ['_token', 'max_upload_size'];
	// The subject line for emails
	protected $email_subject = 'Fiptalk Internal Work Order Submission';
    // Array of views to be sent to each email recipient
    protected $email_views = [
        'lead' => 'fiptalk.fiptalk',
        'copies' => 'default'
    ];
    //Default confirmed state for this IWO type
    protected $confirmed = 1;

	public function __construct(FiptalkWorkOrderValidator $validator)
	{
		parent::__construct();
		$this->validator = $validator;
	}
}
<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class WorkorderExpiryNotification extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'expiry:notify';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send an email notification when an IWO will expire in 7 days';

	protected $subject;
	protected $data;
	protected $recipient;

	/**
	 * Create a new command instance.
	 *
	 * @return \WorkorderExpiryNotification
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$seven_days_in_future = date('Y-m-d', strtotime('1 week'));
		$expiring_iwos = Workorder::where('expiry_date', '=', $seven_days_in_future)->get();

		$this->info("IWOs expiring 7 days from today: " . $expiring_iwos->count());

		if($expiring_iwos->count() > 0)
		{
			foreach($expiring_iwos as $iwo)
			{
				if( ! $iwo->expiry_notification_sent && $iwo->confirmed)
				{
					$this->info("Sending notification to all users linked to: '" . $iwo->title . "'");
					//$this->get_all_emails($iwo->id, $iwo->formtype_id);

					//Send an email notification to all users linked to current IWO

					/**
					 * FORMAT FORM DATA FOR EMAIL
					 */
					$data = [
						// Use the pretty_input() helper to make form input data user friendly and pretty for display in emails
						'form_data'         => pretty_input(unserialize($iwo->workorder)),
						//Get the "pretty" version of the IWO key
						'form_type'         => Formtype::where( 'id', '=', $iwo->formtype_id )->pluck( 'label' ),
						//The confirmed/unconfirmed status of the IWO
						'status'            => ( $iwo->confirmed == 0 ) ? 'unconfirmed' : 'confirmed',
						//IWO reference
						'iwo_ref'           => $iwo->iwo_ref()->pluck('iwo_ref'),
						//    Workorder title
						'iwo_title'         => $iwo->title,
						//    Workorder id
						'iwo_id'            => $iwo->id,
					];

					//Get all email addresses linked to this work order along with copy contacts so we can email them about the update
					$data['recipient'] = $this->get_all_emails( $iwo->id, $iwo->formtype_id );

					Queue::push( '\Iwo\Workers\SendEmail@iwo_expiry_notification', $data );

					$iwo->expiry_notification_sent = 1;
					$iwo->save();
				}
				elseif($iwo->expiry_notification_sent)
				{
					$this->info("Notification already sent to all users linked to: '" . $iwo->title . "'");
				}
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

	protected function get_user_emails($iwo_id = 0)
	{
		return array_unique(User::where('iwo_id', '=', $iwo_id)->lists('email'));
	}

	protected function get_copy_emails($formtype = 0)
	{
		return array_unique(Copy_contact::where('formtype_id', '=', $formtype)->lists('email'));
	}

	protected function get_all_emails($iwo_id = 0, $formtype = 0)
	{
		return array_merge($this->get_user_emails($iwo_id), $this->get_copy_emails($formtype));
	}

}

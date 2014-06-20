<?php

use Iwo\Mailers\Mailer;
use Iwo\FileUpload\FileUpload;
use Iwo\Workers\SendEmail;

class BaseController extends Controller {

	// Copy email contacts retreived from the database
	protected $email_recipients;
	// Path to the email view to use if different from 'emails.<iwo_key>'
	protected $email_view;
	// Page title used on the front-end
	protected $page_title;
	// Instance of FileUpload
	protected $upload;

	public function __construct()
	{
		// Get the default page title from the DB
		$this->page_title = Formtype::where('key', $this->iwo_key)->pluck('title');
		// Get the list of email recipients for this particular form from the DB
		$this->email_recipients = Formtype::where('key', $this->iwo_key)->first()->emailrecipients;
	}

	public function getIndex()
	{
		return View::make('forms.' . $this->iwo_key)->with('page_title', $this->page_title);
	}

	public function postIndex()
	{
		// Use $this->validator set in the sub class to use the validation rules
		// specific to this form
		$this->validator->validate(Input::all());
		// If fails, throws a FormValidationException and redirects back to the form
		// If passes, move on to dealing with any files uploaded
		
		// Resolve the FileUpload class out of the IoC container
		$this->upload = App::make('FileUpload');
		// upload_files method returns an array of the original file names and
		// the new file names after any space removal has taken place
		$file_names = $this->upload->upload_files(Input::file('file'));
		// If there is a problem, upload_files throws a FormFileUploadException.
		// Otherwise redirect to the confirm page with the file names
		return Redirect::to($this->iwo_key . '/confirm')->with('file_names', $file_names['new_file_names'])->withInput(Input::except($this->hidden_from_user));
	}
	

	public function getConfirm()
	{
		// Use the pretty_input() function to make form input data user friendly and pretty for display
		$input = pretty_input(Input::old());
		
		// Reflash the input data for another request so it can be used in the next stage,
		// whether that be submitting the form or going back to the form to make changes
		Session::reflash();
		// Display the confirmation page
		return View::make('confirm', compact('input'))->with(['page_title' => $this->page_title . ": Confirmation", 'iwo_key' => $this->iwo_key]);
	}

	public function getSaveandsend()
	{
		// $data will hold all data to be send to the SendEmail worker used to queue sending of the emails
		$data = [];
		$addresses = [];
		// Get the registered email address entered on the form
		$data['registered_email'] = Input::old('registered_email');
		// Get all email recipients for this form type
		$recipients = Formtype::where('key', $this->iwo_key)->first()->emailrecipients;
		// Extract email addresses and place in array
		if ($recipients->first()) {
			foreach($recipients as $recipient) { $addresses[] = $recipient->email; }
		}
		$data['addresses'] = $addresses;
		// If a view was set in the sub class for the user email, use that. Otherwise use the iwo_key variable
		$data['view_user'] = ($this->email_view) ? $this->email_view : 'emails.' . $this->iwo_key;
		// If a subject was set in the sub class for the user email, use that. Otherwise use the page title
		$data['subject_user'] = ($this->email_subject) ? $this->email_subject : $this->page_title;
		// View to use for copy email(s)
		$data['view_copy'] = 'emails.default';
		// Set the subject for copy emails
		$data['subject_copy'] = $this->iwo_key_label . ' IWO Submitted';
		// Use the pretty_input() function to make form input data user friendly and pretty for display in emails
		$data['form_data'] = pretty_input(Input::old());
		// Get the list of file names if they exist, for attaching
		$data['file_names'] = Session::get('file_names');
		// Extra content for use in the email views
		$data['subject'] = $data['subject_user'];
		$data['formtype'] = $this->iwo_key_label;
		// Send emails
		Queue::push('\Iwo\Workers\SendEmail@SendToUser', $data);
		Queue::push('\Iwo\Workers\SendEmail@SendCopies', $data);
		// Once emails are sent, delete files uploaded for security.
		Queue::push('\Iwo\Workers\DeleteUploads', $data['file_names']);

		// $mailer->sendTo([$registered_email], $subject_user, $view_user, compact('data', 'content'));
		// $mailer->sendTo($addresses, $subject_copy, $view_copy, compact('data', 'content'), $file_names);
		// Queue::push(function($job) use ($mailer, $registered_email, $subject_user, $view_user, $data, $content, $file_names)
		// {
		// 	$job->delete();
		// });
		// Queue::push(function($job) use ($mailer, $addresses, $subject_copy, $view_copy, $data, $content, $file_names)
		// {
		// 	$job->delete();
		// });

		// Redirect to the complete/success page
		return Redirect::route('complete');
	}

	public function missingMethod($parameters = [])
	{
		return Redirect::route('home');
	}

}
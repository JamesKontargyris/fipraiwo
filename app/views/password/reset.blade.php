<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>Password Reset Request</h2>

<p>Dear {{ $data['name'] }},</p>
<p>We recently received a request to reset your Fipra online IWO system password.</p>
<p>Your new password is: {{ $data['new_password'] }}. Please use this to login at <a href="http://iwo.fipra.com">http://iwo.fipra.com</a>, in combination with your Fipra email address.</p>

<p>For security reasons, you will be prompted to update your temporary password to something more memorable when you next login.</p>

</body>
</html>
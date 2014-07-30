<h5 class="no-underline">STATUS</h5>
@if($workorder->confirmed && ! $workorder->cancelled)
<div class="green-highlight"><i class="fa fa-lg fa-lock"></i> CONFIRMED</div>
@elseif($workorder->cancelled && ! $workorder->confirmed)
<div class="red-highlight"><i class="fa fa-lg fa-times"></i> CANCELLED</div>
@else
<div class="orange-highlight"><i class="fa fa-lg fa-unlock"></i> UNCONFIRMED</div>
@endif
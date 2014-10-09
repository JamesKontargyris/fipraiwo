<ul class="actions">
@if( ! $user->can('confirm') && ! $user->can('edit') && ! $user->can('comment') && ! $user->can('cancel'))
	No actions available to viewers.
@elseif($workorder->cancelled != 1)
    @if($user->can('confirm') && ! $workorder->confirmed)
    <li><a href="/manage/confirm" onClick="return confirm('Are you sure you want to confirm this IWO?');" class="primary"><i class="fa fa-check"></i> CONFIRM</a></li>
    @endif
    @if($user->can('confirm') && $workorder->confirmed && ! $workorder->cancelled)
    <!--<li><a href="/manage/unconfirm" onClick="return confirm('Are you sure you want to un-confirm this IWO?');" class="secondary">UN-CONFIRM</a></li>-->
    @endif
    @if($user->can('edit') && ! $workorder->cancelled)
    <li><a href="/manage/edit" class="secondary"><i class="fa fa-edit"></i> EDIT</a></li>
    @endif
    @if($user->can('comment'))
    <li><a href="/manage/note" class="secondary"><i class="fa fa-file-text"></i> ADD A NOTE</a></li>
    @endif
    @if($user->hasRole('Lead') || $user->hasRole('SuperUser'))
        <li><a href="/manage/resend" class="secondary"><i class="fa fa-envelope"></i> RE-SEND EMAIL(S)</a></li>
        @endif
    @if($user->can('cancel') && ! $workorder->confirmed)
    <li><a href="/manage/cancel" onClick="return confirm('Are you sure you want to cancel this IWO? This action cannot be undone.');" class="secondary"> <i class="fa fa-trash"></i> CANCEL</a></li>
    @endif
@else
    @if($user->can('comment'))
    <li><a href="/manage/note" class="secondary"><i class="fa fa-times"></i> ADD A NOTE</a></li>
    @endif
@endif
<li><a href="/manage/logout" class="red-but"><i class="fa fa-times"></i> LOGOUT</a></li>
</ul>
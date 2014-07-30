<h5 class="no-underline">ACTIONS</h5>

<ul class="actions">
@if($workorder->cancelled != 1)
    @if($user->can('confirm') && ! $workorder->confirmed)
    <li><a href="/manage/confirm" onClick="return confirm('Are you sure you want to confirm this IWO?');" class="primary">CONFIRM</a></li>
    @endif
    @if($user->can('confirm') && $workorder->confirmed)
    <!--<li><a href="/manage/unconfirm" onClick="return confirm('Are you sure you want to un-confirm this IWO?');" class="secondary">UN-CONFIRM</a></li>-->
    @endif
    @if($user->can('edit') && ! $workorder->confirmed)
    <li><a href="/manage/edit" class="secondary">EDIT</a></li>
    @endif
    @if($user->can('comment'))
    <li><a href="/manage/note" class="secondary">ADD A NOTE</a></li>
    @endif
    @if($user->can('cancel') && ! $workorder->confirmed)
    <li><a href="/manage/cancel" onClick="return confirm('Are you sure you want to cancel this IWO? This action cannot be undone.');" class="secondary">CANCEL</a></li>
    @endif
@else
    @if($user->can('comment'))
    <li><a href="/manage/note" class="secondary">ADD A NOTE</a></li>
    @endif
@endif
</ul>
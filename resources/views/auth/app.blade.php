<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h2>Dear {!! $userInfo->name !!},</h2>
<p>
    @if($leavedata->status == 3)
        Your leave application form discarded the system.<br>
    @elseif($leavedata->status == 2)
        Your leave application form approved the system.<br>
    @else
        Your leave application form submitted at {!! date('d-m-Y g:i A', strtotime($leavedata->created_at)) !!} to the system and waiting for approval process.<br>
    @endif
</p>

</body>
</html>
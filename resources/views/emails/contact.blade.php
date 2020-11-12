@extends('emails.layout')

@section('title', trans('mails.notifications.contact'))

@section('content')
<tr>
        <td>
            <table id="corps" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p>{{$first_name}} {{$last_name}},</p>
                        <p> {{$message_content}}</p>
</td>
</tr>
</table>
</td>
   
</tr>
@stop
@extends('mail.layout.layout')
@section('content')

<tr>
	<td style="padding: 10px 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
            <p style="margin: 0;">Hello {{$name}},</p>
	</td>
</tr>
<tr>
	<td style="padding: 0 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
		<p style="margin: 0;">Thank you generate issue for support.</p>
                <p style="margin: 0;">#Your Ticket No is: <strong>{{$data->request_no}}</strong></p>
                <p style="margin: 0;">We will contact you very soon!!</p>
	</td>
</tr>
<tr>
	<td style="padding: 0 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
                <p style="margin: 0;"><b>Support Details:</b></p>
                <p style="margin: 0;"><b>Type:</b>{{$data->type->name}}</p>
                <p style="margin: 0;"><b>Screen Name:</b>{{$data->screen_name}}</p>
<!--                <p style="margin: 0;"><b>Contact Preference:</b>{{$data->contact_preference}}</p>-->
                <p style="margin: 0;"><b>Descriptions:</b>{{$data->descriptions}}</p>
	</td>
</tr>
@stop
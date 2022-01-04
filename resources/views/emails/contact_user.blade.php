<div style="width:100%;background-color:#e9e8e8;height:auto; padding:20px">
    <div style="width:100%;margin:auto;background-color:white;padding:11px 20px 35px 20px"><br>
    <h2> Hi {{ ucwords($to) }},</h2>
        <p> {{ ucwords(Auth::user()->name) }} sana mesaj gönderdi.
        <p> {!! $user_message !!} </p>
        <br>
        <p><strong>Kimden:</strong>{{ ucwords(Auth::user()->name) }}</p>
    </div>
<br><br>
Saygılarımızla,<br><strong>{{ config('app.name') }}</strong>
</div>

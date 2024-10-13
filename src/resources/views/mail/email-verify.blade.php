@extends('mail.template')
@section('content')
    <p>
        Hi, <br/>

        Thank you for signing up with Pulsetracker! To complete your registration and activate your account, please verify<br/>
        your email address by clicking the link below:
        <br/>
        <a href="{{$link}}">Verify My Email</a>
        <br/>
        If the button above doesn’t work, copy and paste the following link into your browser:
        <br/>
        {{$link}}

        For security purposes, this link will expire in 24 hours. If you didn’t sign up for a Pulsetracker account, please
        ignore this email.<br/>

        Welcome to Pulsetracker, and we look forward to helping you with seamless location tracking!<br/>

        Best regards,<br/>
        The Pulsetracker Team<br/>
    </p>
@endsection

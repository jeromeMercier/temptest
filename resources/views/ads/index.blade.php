@extends('layout')

@section('content')
<myjob-ad-index ads='{{$ads}}' myjobs='{{$myJobs}}' publishers="{{$publishers}}" students={{$students}}></myjob-ad-index>
@endsection

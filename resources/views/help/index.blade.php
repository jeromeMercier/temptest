@extends('layout')

@section('title')
Help

@endsection

@section('content')
<v-layout row wrap>
    <v-flex xs12 md6 class="px-1">
        <myjob-faq :items="{{json_encode($faq_items_array)}}"></myjob-faq>
    </v-flex>
    <v-flex xs12 md6 class="px-1">
        <myjob-contact></myjob-contact>
    </v-flex>
</v-layout>
@endsection

@extends('layouts.pages.main.tabbed')

@section('title', "Viewing Event: $apiObject->title")

@section('tab.head.content')
    <li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
    <li><a href="#tab-report" data-toggle="tab">Report</a></li>
@endsection

@section('tab.body.content')

    <div class="tab-pane active" id="tab-profile">
        {!! $event->viewer()->btnEdit(route($routes['edit'], [$eventable->id, $event->id])) !!}

        {!! $event->viewer()->btnDelete(route($routes['destroy'], [$eventable->id, $event->id])) !!}

        <hr>

        {!! $event->viewer()->profile($apiObject) !!}
    </div>

    <div class="tab-pane" id="tab-report">
        {!! $event->viewer()->report() !!}
    </div>

@endsection

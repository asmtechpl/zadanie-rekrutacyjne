@extends('layouts.app')

@section('content')
    <post-table :items='@json($posts)'></post-table>
@endsection


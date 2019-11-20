@extends('layouts.app')

@section('content')
<h2>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
<h3>Edit your profile</h3>
{{ Form::open(['action' => ['ProfileController@update', Auth::user()->id], 'method' => 'POST']) }}
    <div class="form-wrapper">
        <div class="form-group">
            {{Form::label('firstname', 'Nama Depan: ')}}
            {{Form::text('firstname', Auth::user()->firstname, ['class' => 'form-control', 'placeholder' => Auth::user()->firstname])}}
        </div>
        <div class="form-group">
            {{Form::label('lastname', 'Nama Belakang: ')}}
            {{Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control', 'placeholder' => Auth::user()->lastname])}}
        </div>
        <div class="form-group">
            {{Form::label('about', 'Deskripsi Diri:')}}
            {{Form::textarea('about', Auth::user()->about, ['class' => 'form-control', 'placeholder' => Auth::user()->about])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Alamat E-Mail:')}}
            {{Form::email('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => Auth::user()->email])}}
        </div>
        <div class="form-group">
            {{Form::label('contact', 'No Hp:')}}
            {{Form::text('contact', Auth::user()->contact, ['class' => 'form-control', 'placeholder' => Auth::user()->contact])}}
        </div>
        <div class="form-group">
            {{Form::label('birthday', 'Tanggal Lahir:')}}
            {{Form::date('birthday', Auth::user()->birthday, ['class' => 'form-control', 'placeholder' => Auth::user()->birthday])}}
        </div>
        <div class="form-group">
            {{Form::label('link', 'Link Personal:')}}
            {{Form::url('link', Auth::user()->link, ['class' => 'form-control', 'placeholder' => Auth::user()->link])}}
        </div>
    </div>
    <div class="form-submit">
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {{Form::hidden('_method', 'PUT')}}
    </div>
    
{{ Form::close() }}

@endsection
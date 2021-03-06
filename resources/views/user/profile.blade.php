@extends('layouts.app')


@section('content')

{{-- <div class="container-fluid">
    <div class="row">
        @include('inc.sidebar-profile')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="profile-content">
                <ul class="list-group">
                    <div style="text-align:center;vertical-align:middle;"><h2 style="padding:10px;margin:0"><strong>Profile</strong></h2></div>
                    <li class="list-group-item">
                        <ul id="profile-info">
                            <li id="profile-info-item1">
                                <strong>Nama Lengkap</strong>
                            </li>
                            <li id="profile-info-item2">
                                <span>{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</span>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item" id="li-profile">
                        <ul id="profile-info">
                            <li id="profile-info-item1">
                                <strong>Deskripsi Diri</strong>
                            <li id="profile-info-item2">
                                @if (Auth::user()->about == 0)
                                    <p class="mb-0" style="color:red;">
                                        Belum ada, silahkan <a href="/profile/{{Auth::user()->username}}/edit"> tambahkan</a>
                                    </p>
                                @else
                                    <span>{{ Auth::user()->about}}</span>                        
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item" id="li-profile">
                        <ul id="profile-info">
                            <li id="profile-info-item1">
                                <strong>Alamat E-mail</strong>
                            </li>
                            <li id="profile-info-item2">
                                <span>{{ Auth::user()->email}}</span>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item" id="li-profile">
                        <ul id="profile-info">
                            <li id="profile-info-item1">
                                <strong>Nomor HP</strong>
                            </li>
                            <li id="profile-info-item2">
                                @if (Auth::user()->contact == 0)
                                    <p class="mb-0" style="color:red;">
                                        Belum ada, silahkan <a href="/profile/{{Auth::user()->username}}/edit"> tambahkan</a>
                                    </p>
                                @else
                                    <span>{{ Auth::user()->contact}}</span>                        
                                @endif
                            </li>
                        </ul>  
                    </li>
                    <li class="list-group-item" id="li-profile">
                        <ul id="profile-info">
                            <li id="profile-info-item1">
                                <strong>Tanggal Lahir</strong>
                            </li>
                            <li id="profile-info-item2">
                                <span>{{date('d-m-Y', strtotime(Auth::user()->birthday))}}</span>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item" id="li-profile">
                        <ul id="profile-info">
                            <li id="profile-info-item1">
                                <strong>Link</strong>
                            </li>
                            <li id="profile-info-item2">
                                <span>
                                    @if (Auth::user()->link == 0)
                                        <p class="mb-0" style="color:red;">
                                            Belum ada, silahkan <a href="/profile/{{Auth::user()->username}}/edit"> tambahkan</a>
                                        </p>
                                    @else
                                        <a href="{{ Auth::user()->link}}" target="_blank">
                                            {{ Auth::user()->link}}
                                        </a>
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </main>
    </div>
</div> --}}
<br>
<div class="container-fluid">
    @include('inc.sidebar-profile')
    <div class="content">
        <ul class="list-group" id="profile">
            <div style="text-align:center;vertical-align:middle;">
                <h2 style="padding:15px;margin:0">
                    <strong>Profil Anda</strong>
                </h2>
            </div>
            <li class="list-group-item">
                <ul class="list-inline">
                    <li class="list-inline-item col-md-2">
                        <strong>Nama Lengkap</strong>
                    </li>
                    <li class="list-inline-item col-md-8">
                        <span>{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</span>
                    </li>
                </ul>
            </li>
            <li class="list-group-item">
                <ul class="list-inline">
                    <li class="list-inline-item col-md-2">
                        <strong>Deskripsi Diri</strong>
                    <li class="list-inline-item col-md-8">
                        @if (count(Auth::user()->about) == 0)
                            <p class="mb-0" style="color:red;">
                                Belum ada, silahkan <a href="/profile/{{Auth::user()->username}}/edit"> tambahkan</a>
                            </p>
                        @else
                            <span>{{ Auth::user()->about}}</span>                        
                        @endif
                    </li>
                </ul>
            </li>
            <li class="list-group-item">
                <ul class="list-inline">
                    <li class="list-inline-item col-md-2">
                        <strong>Alamat E-mail</strong>
                    </li>
                    <li class="list-inline-item col-md-8">
                        <span>{{ Auth::user()->email}}</span>
                    </li>
                </ul>
            </li>
            <li class="list-group-item" id="li-profile">
                <ul class="list-inline" id="profile-info">
                    <li class="list-inline-item col-md-2">
                        <strong>Nomor HP</strong>
                    </li>
                    <li class="list-inline-item col-md-8">
                        @if (Auth::user()->contact == 0)
                            <p class="mb-0" style="color:red;">
                                Belum ada, silahkan <a href="/profile/{{Auth::user()->username}}/edit"> tambahkan</a>
                            </p>
                        @else
                            <span>{{ Auth::user()->contact}}</span>                        
                        @endif
                    </li>
                </ul>  
            </li>
            <li class="list-group-item">
                <ul class="list-inline">
                    <li class="list-inline-item col-md-2">
                        <strong>Tanggal Lahir</strong>
                    </li>
                    <li class="list-inline-item col-md-8">
                        <span>{{date('d-m-Y', strtotime(Auth::user()->birthday))}}</span>
                    </li>
                </ul>
            </li>
            <li class="list-group-item">
                <ul class="list-inline" id="profile-info">
                    <li class="list-inline-item col-md-2">
                        <strong>Link</strong>
                    </li>
                    <li class="list-inline-item col-md-8">
                        <span>
                            @if (count(Auth::user()->link) == 0)
                                <p class="mb-0" style="color:red;">
                                    Belum ada, silahkan <a href="/profile/{{Auth::user()->username}}/edit"> tambahkan</a>
                                </p>
                            @else
                                <a href="{{ Auth::user()->link}}" target="_blank">
                                    {{ Auth::user()->link}}
                                </a>
                            @endif
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endsection
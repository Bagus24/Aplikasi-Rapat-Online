<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rapat Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
        ]) !!};
    </script>

</head>

<body>
<div id="app">
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-primary header-text-light">
            <div class="app-header__logo">
                <div class=""><img src="{{ asset('assets/images/logopoltek.png') }}" alt=""></div>
            </div>

            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

            <div class="app-header__content bg-primary">
                <div class="app-header-left">
                    @guest
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Beranda') }}</a>
                        </li>
                    </ul>
                    @if (Route::has('register'))
                    @endif
                    @else
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">{{ __('Beranda') }}</a>
                        </li>
                    </ul>
                </div>


                <div class="app-header-right ">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{ Auth::user()->nama }}
                                    </div>

                                </div>
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:void(0);" class="dropdown-item">Notifikasi
                                                <div class="ml-auto badge badge-success">Baru</div>
                                            </a>
                                            <a href="{{ url('akun') }}" class="dropdown-item">
                                                Pengaturan Akun
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                {{ __('Keluar') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="app-main">

            <div class="app-main__inner">

                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div id="media-div">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="panel panel-default">
                               
                                    <div class="panel-body">
                                        <chat-messages :messages="messages" kode="{{ $kode }}"></chat-messages>
                                    </div>
                                    <div class="panel-footer">
                                        <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}" kode="{{ $kode }}" nama="{{ Auth::user()->nama }}"></chat-form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
</div>
</div>

        <script src="{{ asset('twilio/twilio-video.min.js') }}"></script>
        <script>
            Twilio.Video.createLocalTracks({
                audio: true,
                video: {
                    width: 300,
                    height: 300,
                }
            }).then(function(localTracks) {
                return Twilio.Video.connect('{{ $accessToken }}', {
                    name: '{{ $kode }}',
                    audio: true,
                    video: {
                        width: 300,
                        height: 300,
                    }
                });
            }).then(function(room) {
                console.log('Successfully joined a Room: ', room.name);

                room.participants.forEach(participantConnected);

                var previewContainer = document.getElementById(room.localParticipant.sid);
                if (!previewContainer || !previewContainer.querySelector('video')) {
                    participantConnected(room.localParticipant);
                }

                room.on('participantConnected', function(participant) {
                    console.log("Joining: ", participant.identity);
                    participantConnected(participant);
                });

                room.on('participantDisconnected', function(participant) {
                    console.log("Disconnect : ", participant.identity);
                    participantDisconnected(participant);
                });
            });
            // additional functions will be added after this point

            function participantConnected(participant) {
                console.log('Participant "%s" connected', participant.identity);

                const div = document.createElement('div');
                div.id = participant.sid;
                div.setAttribute("style", "float : left; margin:20px;");
                div.innerHTML = "<div>"
                participant.identity, "</div>";

                participant.tracks.forEach(function(track) {
                    trackAdded(div, track)
                });

                participant.on('trackAdded', function(track) {
                    trackAdded(div, track)
                });
                participant.on('trackRemoved', trackRemoved);

                document.getElementById('media-div').appendChild(div);
            }

            function participantDisconnected(participant) {
                console.log('Participant "%s" disconnected', participant.identity);

                participant.tracks.forEach(trackRemoved);
                document.getElementById(participant.sid).remove();
            }

            function trackAdded(div, track) {
                div.appendChild(track.attach());
                var video = div.getElementsByTagName("video")[0];
                if (video) {
                    video.setAttribute("style", "width:200px; height:200px");
                }
            }

            function trackRemoved(track) {
                track.detach().forEach(function(element) {
                    element.remove()
                });
            }
        </script>

        <script type="text/javascript" src=" {{ asset('assets/scripts/main.js') }}"></script>
        @endguest
        
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Task4It Manager</title>
    
    <link src="{{ asset('vendor/timelinejs-slider/timeline.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="http://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ asset('/vendor/jasekz/laradrop/css/styles.css')}}" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js" ></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha256-kIxwtDqhOVbQysWu0OpR9QfijdXCfqvXgAUJuv7Uxmg=" crossorigin="anonymous" />
    

    <!-- calendar --> 
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/app.min.css')}}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark sidenav-toggled" id="page-top">
    
    @include('layout.partials.nav');

    <div class="content-wrapper">
        <div class="container-fluid">
            @if(Session::get('alerts'))
                @foreach(Session::get('alerts')->take(4) as $key => $alert)
                <div style="width:300px !important; top: {{100 + 80*$key}}px !important" data-id="{{$alert->id}}" {{-- data-href="{{$alert->url}}" --}} class="flash-message alert {{$alert->type}} alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <a href="#" data-dismiss="alert" style="color: inherit;" >
                        <strong>{{$alert->title}}</strong> {{$alert->message}}
                    </a>
                </div>
                @endforeach
            @endif

            @yield('content')
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    @include('layout.partials.footer')
    @include('layout.partials.logout-modal')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/popper/popper.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <!-- <script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script> -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{ asset('js/sb-admin-datatables.min.js')}}"></script>
    <!-- <script src="{{ asset('js/sb-admin-charts.min.js')}}"></script> -->
    <script src="{{ asset('vendor/timelinejs-slider/timeline.min.js')}}"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha256-FEqEelWI3WouFOo2VWP/uJfs1y8KJ++FLh2Lbqc8SJk=" crossorigin="anonymous"></script>
    <script src="{{ asset('/vendor/jasekz/laradrop/js/enyo.dropzone.js')}}"></script>
    <script src="{{ asset('/vendor/jasekz/laradrop/js/laradrop.js')}}"></script>

    <script src="{{ asset('/vendor/sweetalert2/sweetalert2.all.min.js')}}"></script>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
            $('.notify-bubble').show(400);

            $('.alert').on('closed.bs.alert', function () {
                console.log($(this).data('id'));
                $.ajax({
                    'url':'{{route('notifications.check')}}',
                    'method':'POST',
                    'data':{'_token':'{{ csrf_token() }}','id':$(this).data('id')}
                });
                if($(this).data('href').length>0){
                    window.location = $(this).data('href');
                }
            })
           /*  jQuery('.datetimepickerend').datetimepicker({
            format:'d.m.Y H:i',
            inline:true,
            lang:'ru'
            }); */
            jQuery('.date_timepicker_start').datetimepicker({
                format:'m/d/Y H:i',
                onShow:function( ct ){
                    this.setOptions({
                        maxDate:jQuery('.date_timepicker_end').val()?jQuery('.date_timepicker_end').val():false
                    })
                }
            });
            jQuery('.date_timepicker_end').datetimepicker({
                format:'m/d/Y H:i',
                onShow:function( ct ){
                    this.setOptions({
                        minDate:jQuery('.date_timepicker_start').val()?jQuery('.date_timepicker_start').val():false
                    })
                }
            });          

            $('.datepicker').datepicker();
            $('.js-timeline').Timeline();
             // With custom params:
             if($('.laradrop').length){
                $('.laradrop').laradrop({
                    breadCrumbRootText: 'My Root', // optional 
                    actionConfirmationText: 'Sure about that?', // optional
                    containersUrl:"{{route('laradrop.containers')}}",
                    customData: {"form":$(".custom-data").serializeArray()},
                    onInsertCallback: function (obj){ // optional 
                        // if you need to bind the select button, implement here
                        //console.log('Thumb src: '+obj.src+'. File ID: '+obj.id+'.  Please implement onInsertCallback().');
                        //window.location.href = obj.src;
                        if (obj.src.indexOf("folder") >= 0){
                            swal({
                                title: 'Enter the new name of the folder',
                                input: 'text',
                                showCancelButton: true,
                                confirmButtonText: 'Submit',
                                showLoaderOnConfirm: true,
                                preConfirm: function (name) {
                                    return new Promise(function (resolve, reject) {
                                        $.ajax({
                                            url: "{{URL::to('files/update/')}}/"+obj.id,
                                            data:{'_token':'{{ csrf_token() }}','filename':name},
                                            type: "POST",
                                            success: function(response) {
                                                $("div[file-id="+obj.id+"]").find(".laradrop-filealias").text(name);
                                                resolve();
                                            },
                                            error: function(xhr) {
                                                reject("Something went wrong");
                                            }
                                        });
                                    })
                                },
                                allowOutsideClick: false
                            }).then(function (name) {
                                swal({
                                    type: 'success',
                                    title: 'The folder name has been updated!',
                                    html: 'New folder name: ' + name
                                })
                            })
                        }else{
                            $.ajax({
                                url: "{{URL::to('files/show/')}}/"+obj.id,
                                type: "GET",
                                success: function(response) {
                                    window.location.href = response;
                                },
                                error: function(xhr) {

                                }
                            });
                        }

                    },
                    onErrorCallback: function(msg){ // optional
                        console.log(msg);
                        // if you need an error status indicator, implement here
                        alert('An error occured: '+msg);
                    },
                    onSuccessCallback: function(serverRes){ // optional
                        // if you need a success status indicator, implement here
                        console.log(serverRes);
                    }
                });
            }
        });
        
        @yield('script');
    </script>
    </div>
</body>

</html>
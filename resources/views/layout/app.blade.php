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
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="http://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="/vendor/jasekz/laradrop/css/styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js" ></script>

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/app.min.css')}}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark sidenav-toggled" id="page-top">
    @include('layout.partials.nav');

    <div class="content-wrapper">
        <div class="container-fluid">
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
    <script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js')}}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{ asset('js/sb-admin-datatables.min.js')}}"></script>
    <script src="{{ asset('js/sb-admin-charts.min.js')}}"></script>
    <script src="{{ asset('vendor/timelinejs-slider/timeline.min.js')}}"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <script src="/vendor/jasekz/laradrop/js/enyo.dropzone.js"></script>
    <script src="/vendor/jasekz/laradrop/js/laradrop.js"></script>

    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker();
            $('.js-timeline').Timeline();
             // With custom params:
            $('.laradrop').laradrop({
                breadCrumbRootText: 'My Root', // optional 
                actionConfirmationText: 'Sure about that?', // optional
                customData: {"form":$(".custom-data").serializeArray()},
                onInsertCallback: function (obj){ // optional 
                    //console.log(obj);
                    // if you need to bind the select button, implement here
                    //console.log('Thumb src: '+obj.src+'. File ID: '+obj.id+'.  Please implement onInsertCallback().');
                    //window.location.href = obj.src;
                    $.ajax({
                        url: "{{URL::to('files/show/')}}/"+obj.id,
                        type: "GET",
                        success: function(response) {
                            window.location.href = response;
                        },
                        error: function(xhr) {

                        }
                    });

                },
                onErrorCallback: function(msg){ // optional
                    // if you need an error status indicator, implement here
                    alert('An error occured: '+msg);
                },
                onSuccessCallback: function(serverRes){ // optional
                    // if you need a success status indicator, implement here
                }
            });
        });
        @yield('script');
    </script>
    </div>
</body>

</html>
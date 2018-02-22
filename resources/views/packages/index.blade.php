<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fantasy Form</title>


   @include('packages.css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
    <h2 style="text-align:center" >Select a package to customize</h2>
    <ul>
        @for ($i = 0; $i < count($packages); $i++)
        <li id="{{$i}}" class="open">
            <h4>{{$packages[$i]->name}}</h4>
            <p class="quote">{{$packages[$i]->name}}</p>
            @if($i+1 < count($packages))
            <a class="button" href="#{{$i+1}}">Next
            </a>
            @endif
            <a class="button" href="{{route('packages.show',$packages[$i]->id)}}">Customize it!<span>&#9997;</span>
            </a>
        </li>
        @endfor
        
    </ul>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


    @include('packages.js')
    
</body>

</html>
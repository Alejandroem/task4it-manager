<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fantasy Form</title>


    @include('packages.css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
    {{ Form::open(['route' => 'enquires.store'])}}
    {{ Form::token() }}
    <input type="text" name="package" value="{{$package->id}}" hidden>
    <h2 style="text-align:center">You are customizing {{$package->name}}</h2>
    <ul>
        @for ($i = 0; $i< count($package->options); $i++)
            <li id="{{$i}}" class="open">
                <p style="margin-bottom:1em; color:#fff;">{{$package->options[$i]->subject}}</p>
                <div>
                    @foreach($package->options[$i]->values as $value)
                    <span>
                        <input id="option{{$package->options[$i]->id}}_{{$value->id}}" data-price="{{$value->value}}" name="option[{{$package->options[$i]->id}}]" type="radio" class="field radio" value="{{$value->id}}" @if ($value == $package->options[$i]->values->first()) checked @endif/>
                        <label class="choice" for="option{{$package->options[$i]->id}}_{{$value->id}}">
                            {{$value->name}}
                        </label>
                        <span class="symbol">
                                $   
                            </span>
                            <span class="yellow-text">
                                {{$value->value}}
                            </span>
                    </span>
                    <br>
                    @endforeach
                    @if($i+1< count($package->options))
                        <a class="button" href="#{{$i+1}}">Next
                        </a>
                    @else
                        <a class="button" href="#budget">Next
                        </a>
                    @endif
                </div>
            </li>
            @endfor
            <li id="budget">

                <p style="margin-bottom:1.5em; color:#fff;">This is the total amount of your choices</p>


                <span class="symbol">$</span>
                <span>
                    <input id="total" name="total" disabled type="text" class="field text currency nospin" value="" size="10" />
                </span>
                <br>
                <a class="button" href="#enquire">Get in touch! &rarr;</a>
            </li>
            <li id="enquire">
                <p style="margin-bottom:1.5em; color:#fff;">Personal Information</p>
                <h4>We will contact you as soon as posible!!</h4>
                <span>
                    <input id="first_name" name="first_name" type="text" class="field text fn" value="" size="15" tabindex="33" placeholder="First Name"
                        style="margin-right:1.5em" required>
                </span>
                <span>
                    <input id="last_name" name="last_name" type="text" class="field text ln" value="" size="14" tabindex="34" placeholder="Last Name"style="margin-right:1.5em" required>
                </span>
                <br>
                <br>
                <br>
                <br>
                <div>
                    <input id="email" name="email" type="email" spellcheck="false" class="field text medium" value="" maxlength="255" size="35" placeholder="Email Address" style="margin-right:1.5em" required>
                </div>
                <br>
                <br>
                <br>
                <button style="height:auto!important;" type="submit" class="button">
                    Submit
                    <span style="font-size:25px">&#9996;
                    <span>
                </button>
            </li>
    </ul>

    {{Form::close()}}
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


    @include('packages.js')
    
</body>

</html>
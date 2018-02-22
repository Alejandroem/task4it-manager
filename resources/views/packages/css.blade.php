 <style>
        /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: 400;
            src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(https://themes.googleusercontent.com/static/fonts/sourcesanspro/v5/ODelI1aHBYDBqgeIAH2zlNHq-FFgoDNV3GTKpHwuvtI.woff) format('woff');
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: 700;
            src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://themes.googleusercontent.com/static/fonts/sourcesanspro/v5/toadOcfmlt9b38dHJxOBGIqjGYJUyOXcBwUQbRaNH6c.woff) format('woff');
        }

        li {
            border: 0px solid #000;
            min-height: 350px;
            color: #fff;
            margin-bottom: 250px;
        }

        body {
            background-color: #292929;
            overflow: scroll;
            overflow-x: hidden;
        }

        ul,
        li {
            list-style: none;
        }

        ul {
            display: block;
            margin: 50px auto;
            max-width: 800px;
        }

        li {
            -khtml-opacity: 0.08;
            -moz-opacity: 0.08;
            opacity: 0.08;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=8)";
        }

        ul {
            position: relative;
            font-family: lucida sans unicode, "Source Sans Pro", sans-serif;
        }

        li {
            position: relative;
            opacity: 0.2;
        }

        .open {
            transition: opacity .5s ease-in-out 1s;
            opacity: 1;
        }

        h2 {
            color: #fad05c;
            font-size: 3em;
            margin-bottom: 1.5em;
            font-family: "Source Sans Pro", sans-serif;
        }

        p {
            font-size: 180%;
            line-height: 2;
        }

        .quote {
            border-left: .25em solid #fad05c;
            padding-left: 1em;
            background: #2e2e2e;
            padding-top: .5em;
            padding-bottom: .5em;
            font-size: 120%;
        }

        .button {
            display: inline-block;
            cursor: default;
            background-color: #fdc539;
            width: auto;
            height: 35px;
            margin-top: 3.5em;
            line-height: 30px;
            padding: 5px 12px 0 12px;
            font-size: 20px;
            border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            text-decoration: none;
            text-align: center;
            overflow: hidden;
            -moz-transition: background-color ease-out 100ms 0;
            -webkit-transition: background-color ease-out 100ms 0;
            -o-transition: background-color ease-out 100ms 0;
            transition: background-color ease-out 100ms 0;
            color: #2a2a2a;
            background-image: url(https://s3-eu-west-1.amazonaws.com/typeform-media-static/button-gradient-light.png);
            border-top: 1px solid #000000;
            border-left: 1px solid #000000;
            border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3);
            -webkit-box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3);
            -moz-box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3);
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3), 0 2px 2px rgba(0, 0, 0, 0.16), transparent 0 0 0, transparent 0 0 0, transparent 0 0 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3), 0 2px 2px rgba(0, 0, 0, 0.16), transparent 0 0 0, transparent 0 0 0, transparent 0 0 0;
            -moz-box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.3), 0 2px 2px rgba(0, 0, 0, 0.16), transparent 0 0 0, transparent 0 0 0, transparent 0 0 0;
            text-shadow: rgba(255, 255, 255, 0.4) 0px 1px 1px;
        }

        .button:hover {
            -moz-transition: background-color ease-out 100ms 0;
            -webkit-transition: background-color ease-out 100ms 0;
            -o-transition: background-color ease-out 100ms 0;
            transition: background-color ease-out 100ms 0;
            background-color: #fed46b;
            cursor: pointer;
        }


        .symbol {
            font-size: 120%;
            color: #fad05c
        }

        input[type=radio] {
            font-family: "Consolas", monospace !important;
            font-size: 200% !important;
            margin-top: -2em;
            color: #f44;

        }

        input[type=radio]+label {
            font-size: 120% !important;
            line-height: 2;
            margin-top: 1.5em;
            margin-right: 1em;
        }
        .yellow-text,
        input[type=text],
        input[type=email],
        input[type=url] {
            padding: 0 0 0 0px;
            outline: 0 !important;
            border: 0;
            font-size: 150% !important;
            background: 0;
            color: #fad05c;
            border-bottom: 1px dashed #d9e0eb;
            font: inherit;
            min-width: 30px;
        }

        table,
        tr,
        td {
            border: 0px solid #000;
        }

        thead tr {
            margin-bottom: 1.5em;
            color: #fad05c
        }

        tbody td,
        thead td {
            width: 130px;
            text-align: center;
            line-height: 3;
        }

        tbody tr:nth-child(odd) {
            background-color: #333
        }

        tbody th {
            padding-left: 1em;
        }



        .select {
            display: block;
            vertical-align: middle;
            position: relative;
            width: auto;
            max-width: 350px;
            height: 40px;
            background: #f4f6fb;
            border: 2px solid #d3dae7;
            border-radius: 2px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .select:hover {
            border-color: #c5cddf;
        }

        .select>select {
            display: block;
            width: 100%;
            height: 40px;
            line-height: 17px;
            color: #333;
            background: #f4f6fb;
            border: 0;
            -webkit-appearance: none;
            outline: 0;
            margin: 0;
            font-size: 120%;
            padding: 7px 6px 6px 10px;
        }

        .select>select:focus {
            color: #3c3c3c;
            outline: 0;
            outline-offset: 0;
            -moz-outline-radius: 2px;
        }

        .select:before,
        .select:after {
            content: '';
            position: absolute;
            pointer-events: none;
        }

        .select:before {
            top: 0;
            bottom: 0;
            right: 0;
            width: 35px;
            background: inherit;
        }

        .select:after {
            top: 18px;
            right: 13px;
            width: 0;
            height: 0;
            border: 7px solid transparent;
            border-top-color: #333;
        }
    </style>
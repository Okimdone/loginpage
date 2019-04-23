@extends('homeLayout')

@section('CssAndScripts')
    @parent

    <!-- Inseting jscripts for prof here-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


@endsection

@section('body')

    <!-- SideBar -->
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        @foreach ($modules as $module)
            <a href="#" class="w3-bar-item w3-button modules" >{{ strtoupper($module->module) }}</a>
        @endforeach
    </div>

    <div id="main">

        <div class="w3-teal">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h3> Bonjour, Mr. {{ $nom_prof }}</h3>

                <div id="log-out-div">
                    <a href="logout.php" id="log-out"><img src="V/assets/img/logout.png" alt="Log Out" height="50" width="50"></a>
                </div>
            </div>
        </div>

        <div class="w3-container" id='mainContainer'>

            <h5> Veuillez Selectionner un module! </h5>

        </div>
    </div>

@endsection

@extends('layout.app')

<style>
    .grid-here {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    @media only screen and (max-width: 1500px) {
        .grid-here {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media only screen and (max-width: 1250px) {
        .grid-here {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media only screen and (max-width: 680px) {
        .grid-here {
            grid-template-columns: 1fr;
        }
    }

    .character img {
        width: 100%;
    }

    .character {
        text-align: center;
        justify-self: center;
        text-align: -webkit-center;
        cursor: pointer;
    }

    .trim {
        max-height: 200px;
        max-width: 200px;
        overflow: hidden;
    }

    .button-background {
        background-color: #eee !important;
    }
</style>

@section('content')
    <div class="w3-main w3-content w3-padding" style="margin-top:100px">
        <a href="characters/importAll" class="w3-button button-background">
            Import All
        </a>
        @if ($characters)
            <h1>
                Characters
            </h1>
            <div class="grid-here" id="characters">
                @foreach ($characters as $character)
                    <div class="character" onclick="popup({{ $character }})">
                        <div class="trim">
                            <img src="{{ $character->image }}" alt="{{ $character->name }}">
                        </div>
                        <h3>{{ $character->name }}</h3>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-content"></div>
        </div>
    </div>
    <script>
        function popup(element) {
            modal = document.getElementById("myModal");
            content = document.getElementById("modal-content");

            modal.style.display = "block";
            html = '<h3>' + element.id + '</h3>';
            html += '<h1>' + element.name + '</h1>';
            html += '<img src="' + element.image + '"/>';
            html += '<p>' + element.description + '</p>';
            content.innerHTML = html

            console.log(content);
        }
        window.onload = function() {
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        };
    </script>
@endsection

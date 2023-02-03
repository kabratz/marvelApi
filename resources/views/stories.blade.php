@extends('layout.app')

<style>
    h3 {
        font-weight: bold !important;
    }

    .grid-here {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    .character img {
        width: 50%;
    }

    .character {
        text-align: center;
        justify-self: center;
        text-align: -webkit-center;
    }

    .trim {
        max-height: 200px;
        max-width: 200px;
        overflow: hidden;
    }

    .story {
        border: 1px solid #ccc;
        padding: 4%;
        cursor: pointer;
    }

    .button-background {
        background-color: #eee !important;
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
    .modal-content img{
        max-width: 150px !important;
    }
    .character{
        padding: 10px
    }
    #modalNewCharacter{
        padding-top: 30vh !important;
    }
</style>

@section('content')
    <div class="w3-main w3-content w3-padding" style="margin-top:100px">
        <a href="stories/importAll" class="w3-button button-background">
            Import All
        </a>
        @if ($stories)
            <h1>
                Stories
            </h1>
            <div class="grid-here" id="stories">
                @foreach ($stories as $story)
                    <div class="story" onclick="popup({{ $story }})">
                        <h3>{{ $story->title }}</h3>
                    </div>
                @endforeach
            </div>
        @endif
    </div>


    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <div id="modal-content"></div>
        </div>
    </div>

    <div id="modalNewCharacter" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span id="closeModalCharacter" class="close">&times;</span>
            <div id="modal-character-content"></div>
        </div>
    </div>

    <script>
        function popup(element) {
            modal = document.getElementById("myModal");
            content = document.getElementById("modal-content");

            modal.style.display = "block";

            html = '<h3>' + element.id + '</h3>';
            html += '<h1>' + element.title + '</h1>';
            html += '<p>' + element.description + '</p>';
            html += '<hr>';
            html += '<h3>Characters</h3>';
            html += '<a onclick=addNewcharacter('+element.id+') class="w3-button button-background">Add new Character</a>';
            if (element.characters)
            {
                html += '<div class="grid-here">';
                element.characters.forEach(character => {
                    html += '<div class="character">';
                        html += '<h3>' + character.id + '</h3>';
                        html += '<h1>' + character.name + '</h1>';
                        html += '<img src="' + character.image + '"/>';
                        html += '<p>' + character.description + '</p>';
                        html += '<a  class="w3-button button-background" onclick="removeCharacter('+character.id+','+element.id+')" style="color:red">&times; Remove Character</a>';
                    html += '</div>';
                });
                html += '</div>';

            }
            content.innerHTML = html
        }
        
        window.onload = function() {
            // Get the modal
            var modal = document.getElementById("myModal");
            var modalCharacter = document.getElementById("modalNewCharacter");

            // Get the <span> element that closes the modal
            var span = document.getElementById("closeModal");
            var spanCharacter = document.getElementById("closeModalCharacter");

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
            spanCharacter.onclick = function() {
                modalCharacter.style.display = "none";
            }
            
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                if (event.target == modalCharacter) {
                    modalCharacter.style.display = "none";
                }
            }
            
        };

        function addNewcharacter(storyId)
        {
            modalCharacter = document.getElementById("modalNewCharacter");
            contentCharacter = document.getElementById("modal-character-content");
            modalCharacter.style.display = "block";
            $.ajax({
                type: "get",
                url: '/stories-character/characters',
                data: {'story_id': storyId},
                success: function(result){
                    html = '<h1>Add a new Character</h1>';
                    html += '<select id="character_id" name="character_id">';
                    
                    result.forEach(character => {
                        html += '<option  value="' + character.id  + '">' +character.name + '</option>'
                    });
                    html += '</select>';
                    html += '<button onClick="newCharacter('+storyId+')">submit</button';
        
                    contentCharacter.innerHTML = html
                },

            });

        }

        function newCharacter(storyId)
        {
            characterId = document.getElementById('character_id').value;

            $.ajax({
                type: "get",
                url: '/stories-character',
                data: {'story': storyId,
                'character': parseInt(characterId),},
                success: function(result)
                {
                    alert(result.msg)
                    location.reload()
                },

            });

        }
        function removeCharacter(characterId, storyId)
        {
            $.ajax({
                type: "get",
                url: '/stories-character/delete',
                data: {'story_id': storyId,
                'character_id': parseInt(characterId),},
                success: function(result)
                {
                    console.log(result)

                    alert(result.msg)
                    location.reload()
                },

            });
        }
    </script>
@endsection

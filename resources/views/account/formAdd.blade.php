@extends('template')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/modal.css') }}">
@endsection
@section('content')
<form>
    <label>Tipo de Conta</label><br>
    <select></select><br>
    <label>Cliente</label><br>
    <input id="client" type="text"> <input type="button" id="create" value="Criar Novo Cliente"> <input type="button" id="search" value="Pesquisar Cliente"><br>
    <label>Depósito Inicial</label><br>
    <input><br>
    <button type="submit">Criar nova conta</button>
</form>
<div id="createModal" class="modal">
    <div class="modal-content">
        @include('client.add')
    </div>

</div>
<div id="searchModal" class="modal">
    <div class="modal-content">
        @include('client.search')
    </div>

</div>
<script>
// Get the modal
var modal = document.getElementById('createModal');

// Get the button that opens the modal
var btn = document.getElementById("create");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
    </script>
@endsection
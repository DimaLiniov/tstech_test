@if(session()->get('success'))
    <div>
        {{ session()->get('success') }}
    </div>
@endif
<form method="POST" enctype="multipart/form-data" action="{{route('main.store')}}">
    @csrf
    Сгенерировать число : <input type="submit" id="generate" value="GENERATE">
</form>

<form id="form" method="GET" enctype="multipart/form-data" action="{{route('main.show', '' )}}">
    <input id="myId"   type="number" >
    <input type="submit" id="retrieve" value="Retrieve" >
</form>


@if(isset($main))Список всех записей : @foreach($main as $m){{$m}} @endforeach
@elseif(isset($number)) Вы выбрали {{$number}}
@else Число с таким id не найдено
@endif
<script >
    document.addEventListener("DOMContentLoaded", function(event) {
        retrieve.onclick = function(){
            let val = document.getElementById('myId').value;
            let act = document.getElementById('form');
            act.action = act.action + '/' + val;
            console.log(act.action);
            var ef = new Event('submit');
            search_form.dispatchEvent(ef);
        }
    });
</script>


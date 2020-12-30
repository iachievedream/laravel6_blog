@if(isset(Auth::user()->name))
    使用者：{{Auth::user()->name}}<br>
@else
    進入身分：訪客<br>
@endif

<a href="/edit/{{$articles->id}}">編輯</a>

<form action="/show/delete/{{$articles->id}}" method="POST">
    @csrf
    <button type="submit">刪除</button>
</form>
<a href="/">上一頁</a><br>
單一文章列表<br>
標題---內容---作者<br>
{{$articles->title}}---
{{$articles->content}}---
{{$articles->author}}
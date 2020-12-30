@guest
	<a href="{{route('login')}}">登入</a>
	<a href="{{route('register')}}">註冊</a>
@else
	<form method="POST" action="{{route('logout')}}">
		@csrf
		使用者為：{{Auth::user()->name}}
		<button type="submit">登出</button>
	</form>
@endguest

<a href="/create">新增文章</a><br>
文章列表<br>
標題--作者<br>
@foreach($articles as $article)
	<a href="show/{{$article->id}}">{{$article->title}}</a>---
	{{$article->author}}<br>
@endforeach
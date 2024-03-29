@props(['recentPosts'])

<div class="side">
    <h3 class="sidebar-heading">Recent Blog</h3>
    @foreach ($recentPosts as $recent_post)
    <div class="f-blog">
        <a href="{{route('post.show', $recent_post)}}" class="blog-img"
            style="background-image: url({{asset('storage/'.$recent_post->image->path.'')}});">
        </a>
        <div class="desc">
            <p class="admin"><span>{{$recent_post->created_at->diffForHumans()}}</span></p>
            <h2><a href="{{route('post.show', $recent_post)}}">{{\Str::limit($recent_post->title, 20)}}</a></h2>
            <p>{{$recent_post->excerpt}}</p>
        </div>
    </div>
    @endforeach
</div>
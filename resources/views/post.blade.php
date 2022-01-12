@extends('main_layouts.master')

@section('title', $post->title.'| MyBlog')

@section('custom_css')
    <style>
        .class-single .desc img{
            width: 100%;
        }
        .class-single .desc h1, h2, h3, h4, h5, h6, figure, p{
            line-break: anywhere !important;
        } 
    </style>
@endsection

@section('content')
<div class="colorlib-classes">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row row-pb-lg">
                    <div class="col-md-12 animate-box">
                        <div class="classes class-single">
                            <div class="classes-img"
                                style="background-image: url({{asset('storage/'.$post->image->path.'')}});">
                            </div>
                            <div class="desc desc2">
                                {!!$post->body!!}
                                <p><a href="#" class="btn btn-primary btn-outline btn-lg">Live Preview</a> or <a
                                        href="#" class="btn btn-primary btn-lg">Download File</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-pb-lg animate-box">
                    <div class="col-md-12">
                        <h2 class="colorlib-heading-2">{{$post->comments->count()}} Comments</h2>
                        @foreach ($post->comments as $comment)
                        <div id="comment_{{$comment->id}}" class="review">
                            <div class="user-img"
                                style="background-image: url({{
                                    $comment->user->image 
                                    ?
                                    asset('storage/'.$comment->user->image->path.'') 
                                    :
                                    'https://us.123rf.com/450wm/happyvector071/happyvector0711904/happyvector071190416116/120957921-creative-illustration-of-default-avatar-profile-placeholder-isolated-on-background-art-design-grey-p.jpg?ver=6'
                                }})"></div>
                            <div class="desc">
                                <h4>
                                    <span class="text-left">{{$comment->user->name}}</span>
                                    <span class="text-right">{{$comment->created_at->diffForHumans()}}</span>
                                </h4>
                                <p>{{$comment->the_comment}}</p>
                                <p class="star">
                                    <span class="text-left"><a href="#" class="reply"><i
                                                class="icon-reply"></i></a></span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>

                <div class="row animate-box">

                    <x-blog.message :status="'success'"/>

                    <div class="col-md-12">
                        <h2 class="colorlib-heading-2">Say something</h2>
                        @auth
                        <form method="POST" action="{{route('post.add_comment', $post)}}">
                            @csrf

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <!-- <label for="message">Message</label> -->
                                    <textarea name="the_comment" id="the_comment" cols="30" rows="10"
                                        class="form-control" placeholder="Say something about us"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn btn-primary">
                            </div>
                        </form>
                        @endauth
                        @guest
                        <p class="lead">
                            <a href="{{route('login')}}">Login</a>
                            OR
                            <a href="{{route('register')}}">Register</a>
                            to write comment
                        </p>
                        @endguest


                    </div>
                </div>
            </div>

            <!-- SIDEBAR: start -->
            <div class="col-md-4 animate-box">
                <div class="sidebar">
                    <x-blog.side-categories :categories="$categories" />
                    <x-blog.side-recent-posts :recentPosts="$recent_posts" />
                    <x-blog.side-tags :tags="$tags" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
 <script>
    setTimeout(() => {
        $(".global-message").fadeOut();
    }, 5000);
</script>   
@endsection
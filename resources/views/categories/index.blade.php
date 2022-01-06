@extends('main_layouts.master')

@section('title', 'MyBlog | Categories')

@section('content')
<div class="colorlib-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12 categories-col">

                @if (!count($categories))
                <p class="lead">
                    There are no categories here, sorry.
                </p>
                @else
                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-md-3">

                        <div class="block-21 d-flex animate-box post">
                            <div class="text">
                                <h3 class="heading"><a
                                        href="{{route('categories.show', $category)}}">{{$category->name}}</a></h3>
                                <div class="meta">
                                    <div class="date"><a href="#"><span class="icon-calendar"></span>
                                            {{$category->created_at->diffForHumans()}}</a></div>
                                    <div class="author">
                                        <a href="#">
                                            <span class="icon-user2"></span>
                                            {{$category->user->name}}
                                        </a>
                                    </div>
                                    <div class="post-count">
                                        <a href="{{route('categories.show', $category)}}">
                                            <span class="icon-tag"></span>
                                            {{$category->posts_count}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
                @endif

                {{$categories->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
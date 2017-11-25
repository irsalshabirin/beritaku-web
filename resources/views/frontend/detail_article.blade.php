@extends('frontend.master')

@section('header_title')
{{ $title or '' }}
@endsection

<!--
@section('contentheader_title')
{{  $title  or '' }}
@endsection

@section('contentheader_description')
{{ $title_description or '' }}
@endsection-->

@section('class-parent-div')
{{ 'demo-blog--blogpost' }}
@endsection

@section('main-content')
<div class="demo-back">
    <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="{{ URL::previous() }}" title="go back" role="button">
        <i class="material-icons" role="presentation">arrow_back</i>
    </a>
</div>
<div class="mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col">
    <div class="mdl-card__media mdl-color-text--grey-50" style="background-image: url({{ $article->media_content_url . '?w=780&q=90' }});">
        <h3 style="background:rgba(0,0,0,0.5);">{{ $article->title }}</h3>
    </div>
    <div class="mdl-color-text--grey-700 mdl-card__supporting-text meta">
        <div class="minilogo" style="background-image: url({{ $article->feed->icon_url  }});"></div>
        <div>
            <a href="#"><strong>{{ $article->feed->title }}</strong></a>
            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->publish_date))->diffForHumans() }}</span>
        </div>
        <div class="section-spacer"></div>
    </div>
    <div class="mdl-color-text--grey-700 mdl-card__supporting-text">
        <p>
            {!! $article->content !!}
        </p>
        <br/>
        <p>
            @if(isset($keywords))
                @foreach ($keywords as $keyword)
                    <b>{{ $keyword->word }}</b> ({{ $keyword->count }}), 
                @endforeach
            @endif
        </p>
        <br/>
        <a href="{{ $article->link }}" target="_blank">View Original Article</a>

    </div>
</div>

<!--<nav class="demo-nav mdl-color-text--grey-50 mdl-cell mdl-cell--12-col">
    <a href="index.html" class="demo-nav__button">
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
            <i class="material-icons">arrow_back</i>
        </button>
        Newer
    </a>
    <div class="section-spacer"></div>
    <a href="index.html" class="demo-nav__button">
        Older
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
            <i class="material-icons">arrow_forward</i>
        </button>
    </a>
</nav>-->

@endsection



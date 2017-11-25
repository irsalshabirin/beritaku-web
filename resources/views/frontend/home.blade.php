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

@section('main-content')

    @foreach ($centroids as $centroid)
    <div class="mdl-card on-the-road-again mdl-cell mdl-cell--12-col">
        <div class="mdl-card__media mdl-color-text--grey-50">
            <h3><a href="{{ url('/') . '/centroid/' . $centroid->id }}">{{ $centroid->words }} </a></h3>
        </div>
        <div class="mdl-color-text--grey-600 mdl-card__supporting-text">
            {{ $centroid->id }} {{ isset($centroid->description) ? $centroid->description : ""  }}
            <ul class="mdl-list">

                @foreach($centroid->articles->slice(0, $limit_article) as $article) 
                <li class="mdl-list__item mdl-list__item--three-line">
                    <span class="mdl-list__item-primary-content">
                        <a href="{{ url('/article/' . $article->id )}}"><span>{{ str_limit($article->title, $limit = 60, $end = '...') }}</span></a> <small>({{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->publish_date))->diffForHumans() }})</small>
                        <!--br/><a href="#"><small>{{ $article->feed->title }}</small></a-->
                        <span class="mdl-list__item-text-body">
                            <a href="#"><small>{{ $article->feed->title }}</small></a> - {{ str_limit(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', preg_replace('/\s+/', ' ', strip_tags($article->content))), $limit = 200, $end = '...') }}
                        </span>
                    </span>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
    @endforeach

    @if(isset($page))
    <nav class="demo-nav mdl-cell mdl-cell--12-col">

        @if($page >= 2)
        <a href="{{ url('/') . '?page=' . ((int) $page - 1)  }}" class="demo-nav__button">
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation" data-upgraded=",MaterialButton,MaterialRipple">
                <i class="material-icons">arrow_back</i>
                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
            Prev
        </a>
        @endif

        <div class="section-spacer"></div>

        <a href="{{ url('/') . '?page=' . ((int) $page + 1)  }}" class="demo-nav__button" title="show more">
            Next
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons" role="presentation">arrow_forward</i>
            </button>
        </a>
    </nav>
    @endif
@endsection
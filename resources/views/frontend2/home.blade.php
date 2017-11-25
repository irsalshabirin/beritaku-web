@extends('frontend2.master')

@section('header_title')
    {{ $title or '' }}
@endsection

<!--
@section('contentheader_description')
{{ $title_description or '' }}
@endsection-->

@section('main-content')
<!-- content-section-starts-here -->
<div class="main-body">
    <div class="wrap">
        <div class="col-md-8 content-left">
            @if(isset($is_show_slide_show) && $is_show_slide_show == true)
                @if(isset($popular_news))
                    <!-- start- slider -->
                    <div class="slider">
                        <div class="callbacks_wrap">
                            <ul class="rslides" id="slider">
                                @foreach($popular_news as $new)
                                    @if(isset($new->media_content_url) && $new->media_content_url != "" && strpos($new->media_content_url, "https://") !== true)
                                        <li>
                                            <img src="{{ $new->media_content_url }}" alt="" onerror="ImgError(this);">
                                            <div class="caption">
                                                <a href="{{ url('2/article/' . $new->id) }}"> {{ str_limit($new->title, $limit = 150, $end = '...') }} </a>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- end- slider -->
                @endif
            @endif

            @if(isset($centroids))
                @foreach ($centroids as $centroid)
                    <div class="articles">
                        <header>
                            <a href="{{ url('2/centroid/' . $centroid->id) }}"><h3 class="title-head">{{ $centroid->words }}</h3></a>
                        </header>
                        @foreach($centroid->articles->slice(0, $limit_article) as $article) 
                            <div class="article">

                                @if(($article->media_content_url))
                                    <div class="article-left">
                                        <a href="{{ url('2/article/' . $article->id) }}">
                                            <div class="center-cropped">
                                                    <img src="{{ $article->media_content_url }}"  onerror="ImgError(this);"/>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="article-right">
                                        <div class="article-title">
                                            <p>
                                                <!-- On Feb 25, 2015  -->
                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->publish_date))->diffForHumans() }}
                                                <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a>
                                                <a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>104 </a>
                                                <a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>52</a> -->
                                            </p>
                                            <a class="title" href="{{ url('2/article/' . $article->id) }}"> {{ str_limit($article->title, $limit = 60, $end = '...') }} </a>
                                        </div>
                                        <div class="article-text">
                                            <p>{{ str_limit(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', preg_replace('/\s+/', ' ', strip_tags($article->content))), $limit = 200, $end = '...') }}</p>
                                            <!-- <a href="single.html">
                                                <img src="images/more.png" alt="" />
                                            </a> -->
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                @elseif($article->media_content_url == "")
                                    <div class="article-title">
                                        <p>
                                            <!-- On Feb 25, 2015  -->
                                            {{ \Carbon\Carbon::createFromTimeStamp(strtotime($article->publish_date))->diffForHumans() }}
                                            <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a>
                                            <a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>104 </a>
                                            <a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>52</a> -->
                                        </p>
                                        <a class="title" href="{{ url('2/article/' . $article->id) }}"> {{ str_limit($article->title, $limit = 70, $end = '...') }} </a>
                                    </div>
                                    <div class="article-text">
                                        <p>{{ str_limit(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', preg_replace('/\s+/', ' ', strip_tags($article->content))), $limit = 400, $end = '...') }}</p>
                                        <!-- <a href="single.html">
                                            <img src="images/more.png" alt="" />
                                        </a> -->
                                        <div class="clearfix"></div>
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            @endif

            <!-- <div class="life-style">
                <header>
                    <h3 class="title-head">Life Style</h3>
                </header>
                <div class="life-style-grids">
                    <div class="life-style-left-grid">
                        <a href="single.html"><img src="images/l1.jpg" alt="" /></a>
                        <a class="title" href="single.html">It is a long established fact that a reader will be distracted.</a>
                    </div>
                    <div class="life-style-right-grid">
                        <a href="single.html"><img src="images/l2.jpg" alt="" /></a>
                        <a class="title" href="single.html">There are many variations of passages of Lorem Ipsum available.</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="life-style-grids">
                    <div class="life-style-left-grid">
                        <a href="single.html"><img src="images/l3.jpg" alt="" /></a>
                        <a class="title" href="single.html">Contrary to popular belief, Lorem Ipsum is not simply random text.</a>
                    </div>
                    <div class="life-style-right-grid">
                        <a href="single.html"><img src="images/l4.jpg" alt="" /></a>
                        <a class="title" href="single.html">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div> -->

            <!-- <div class="sports-top">
                <div class="s-grid-left">
                    <div class="cricket">
                        <header>
                            <h3 class="title-head">Business</h3>
                        </header>
                        <div class="c-sports-main">
                            <div class="c-image">
                                <a href="single.html"><img src="images/bus1.jpg" alt="" /></a>
                            </div>
                            <div class="c-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Feb 25, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="s-grid-small">
                            <div class="sc-image">
                                <a href="single.html"><img src="images/bus2.jpg" alt="" /></a>
                            </div>
                            <div class="sc-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Mar 21, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="s-grid-small">
                            <div class="sc-image">
                                <a href="single.html"><img src="images/bus3.jpg" alt="" /></a>
                            </div>
                            <div class="sc-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Jan 25, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="s-grid-small">
                            <div class="sc-image">
                                <a href="single.html"><img src="images/bus4.jpg" alt="" /></a>
                            </div>
                            <div class="sc-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Jul 19, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="s-grid-right">
                    <div class="cricket">
                        <header>
                            <h3 class="title-popular">Technology</h3>
                        </header>
                        <div class="c-sports-main">
                            <div class="c-image">
                                <a href="single.html"><img src="images/tec1.jpg" alt="" /></a>
                            </div>
                            <div class="c-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Apr 22, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="s-grid-small">
                            <div class="sc-image">
                                <a href="single.html"><img src="images/tec2.jpg" alt="" /></a>
                            </div>
                            <div class="sc-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Jan 19, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="s-grid-small">
                            <div class="sc-image">
                                <a href="single.html"><img src="images/tec3.jpg" alt="" /></a>
                            </div>
                            <div class="sc-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Jun 25, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="s-grid-small">
                            <div class="sc-image">
                                <a href="single.html"><img src="images/tec4.jpg" alt="" /></a>
                            </div>
                            <div class="sc-text">
                                <h6>Lorem Ipsum</h6>
                                <a class="power" href="single.html">It is a long established fact that a reader</a>
                                <p class="date">On Jul 19, 2015</p>
                                <a class="reu" href="single.html"><img src="images/more.png" alt="" /></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> -->

        </div>

        <!-- Sidebar - Start -->
        <div class="col-md-4 side-bar">
            <div class="first_half">
                <!-- <div class="newsletter">
                    <h1 class="side-title-head">Newsletter</h1>
                    <p class="sign">Sign up to receive our free newsletters!</p>
                    <form>
                        <input type="text" class="text" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}">
                        <input type="submit" value="submit">
                    </form>
                </div> -->

                <div class="list_vertical">
                    <section class="accordation_menu">
                        @if(isset($popular_news))
                            <div>
                                <input id="label-1" name="lida" type="radio" checked/>
                                <label for="label-1" id="item1"><i class="icon-leaf" id="i2"></i>Berita Terpopuler<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
                                <div class="content" id="a1">
                                    <div class="scrollbar" id="style-2">
                                        <div class="force-overflow">
                                            <div class="popular-post-grids">
                                                @foreach($popular_news as $new)
                                                    <div class="popular-post-grid">
                                                        <div class="post-img">
                                                            <a href="{{ url('2/article/' . $new->id) }}"><img src="{{ $new->media_content_url }}" alt="" onerror="ImgError(this);"/></a>
                                                        </div>
                                                        <div class="post-text">
                                                            <a class="pp-title" href="{{ url('2/article/' . $new->id) }}"> {{ str_limit($new->title, $limit = 50, $end = '...') }} </a>
                                                            <p>
                                                                <!-- On Apr 14  -->
                                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($new->publish_date))->diffForHumans() }}
                                                                <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>2 </a> -->
                                                                <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>56 </a> -->
                                                            </p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(isset($headline_news))
                            <div>
                                <input id="label-2" name="lida" type="radio" />
                                <label for="label-2" id="item2"><i class="icon-leaf" id="i2"></i>Berita Terbaru<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
                                <div class="content" id="a2">
                                    <div class="scrollbar" id="style-2">
                                        <div class="force-overflow">
                                            <div class="popular-post-grids">
                                                @foreach($headline_news as $headline)
                                                    <div class="popular-post-grid">
                                                        <div class="post-img">
                                                            <a href="{{ url('2/article/' . $headline->id) }}"><img src="{{ $headline->media_content_url }}" alt="" onerror="ImgError(this);"/></a>
                                                        </div>
                                                        <div class="post-text">
                                                            <a class="pp-title" href="{{ url('2/article/' . $headline->id) }}"> {{ str_limit($headline->title, $limit = 50, $end = '...') }} </a>
                                                            <p>
                                                                <!-- On Apr 14  -->
                                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($headline->publish_date))->diffForHumans() }}
                                                                <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>2 </a> -->
                                                                <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>56 </a> -->
                                                            </p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(isset($random_news))
                            <div>
                                <input id="label-3" name="lida" type="radio"  />
                                <label for="label-3" id="item3"><i class="ferme"> </i>Berita Random<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
                                <div class="content" id="a1">
                                    <div class="scrollbar" id="style-2">
                                        <div class="force-overflow">
                                            <div class="popular-post-grids">

                                                @foreach($random_news as $random)
                                                    <div class="popular-post-grid">
                                                        <div class="post-img">
                                                            <a href="{{ url('2/article/' . $random->id) }}"><img src="{{ $random->media_content_url }}" alt="" onerror="ImgError(this);"/></a>
                                                        </div>
                                                        <div class="post-text">
                                                            <a class="pp-title" href="{{ url('2/article/' . $random->id) }}"> {{ str_limit($random->title, $limit = 50, $end = '...') }} </a>
                                                            <p>
                                                                <!-- On Apr 14  -->
                                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($random->publish_date))->diffForHumans() }}
                                                                <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>2 </a> -->
                                                                <!-- <a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>56 </a> -->
                                                            </p>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        

                        <!-- <div>
                            <input id="label-3" name="lida" type="radio"/>
                            <label for="label-3" id="item3"><i class="icon-trophy" id="i3"></i>Comments<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
                            <div class="content" id="a3">
                                <div class="scrollbar" id="style-2">
                                    <div class="force-overflow">
                                        <div class="response">
                                            <div class="media response-info">
                                                <div class="media-left response-text-left">
                                                    <a href="#">
                                                    <img class="media-object" src="images/icon1.png" alt="" />
                                                    </a>
                                                    <h5><a href="#">Username</a></h5>
                                                </div>
                                                <div class="media-body response-text-right">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    </p>
                                                    <ul>
                                                        <li>MARCH 21, 2015</li>
                                                        <li><a href="single.html">Reply</a></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="media response-info">
                                                <div class="media-left response-text-left">
                                                    <a href="#">
                                                    <img class="media-object" src="images/icon1.png" alt="" />
                                                    </a>
                                                    <h5><a href="#">Username</a></h5>
                                                </div>
                                                <div class="media-body response-text-right">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    </p>
                                                    <ul>
                                                        <li>MARCH 26, 2015</li>
                                                        <li><a href="single.html">Reply</a></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="media response-info">
                                                <div class="media-left response-text-left">
                                                    <a href="#">
                                                    <img class="media-object" src="images/icon1.png" alt="" />
                                                    </a>
                                                    <h5><a href="#">Username</a></h5>
                                                </div>
                                                <div class="media-body response-text-right">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    </p>
                                                    <ul>
                                                        <li>MAY 25, 2015</li>
                                                        <li><a href="single.html">Reply</a></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="media response-info">
                                                <div class="media-left response-text-left">
                                                    <a href="#">
                                                    <img class="media-object" src="images/icon1.png" alt="" />
                                                    </a>
                                                    <h5><a href="#">Username</a></h5>
                                                </div>
                                                <div class="media-body response-text-right">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    </p>
                                                    <ul>
                                                        <li>FEB 13, 2015</li>
                                                        <li><a href="single.html">Reply</a></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="media response-info">
                                                <div class="media-left response-text-left">
                                                    <a href="#">
                                                    <img class="media-object" src="images/icon1.png" alt="" />
                                                    </a>
                                                    <h5><a href="#">Username</a></h5>
                                                </div>
                                                <div class="media-body response-text-right">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    </p>
                                                    <ul>
                                                        <li>JAN 28, 2015</li>
                                                        <li><a href="single.html">Reply</a></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="media response-info">
                                                <div class="media-left response-text-left">
                                                    <a href="#">
                                                    <img class="media-object" src="images/icon1.png" alt="" />
                                                    </a>
                                                    <h5><a href="#">Username</a></h5>
                                                </div>
                                                <div class="media-body response-text-right">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    </p>
                                                    <ul>
                                                        <li>APR 18, 2015</li>
                                                        <li><a href="single.html">Reply</a></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                            <div class="media response-info">
                                                <div class="media-left response-text-left">
                                                    <a href="#">
                                                    <img class="media-object" src="images/icon1.png" alt="" />
                                                    </a>
                                                    <h5><a href="#">Username</a></h5>
                                                </div>
                                                <div class="media-body response-text-right">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available, 
                                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                    </p>
                                                    <ul>
                                                        <li>DEC 25, 2014</li>
                                                        <li><a href="single.html">Reply</a></li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </section>
                </div>

                <!-- <div class="side-bar-articles">
                    <div class="side-bar-article">
                        <a href="single.html"><img src="images/sai.jpg" alt="" /></a>
                        <div class="side-bar-article-title">
                            <a href="single.html">Contrary to popular belief, Lorem Ipsum is not simply random text</a>
                        </div>
                    </div>
                    <div class="side-bar-article">
                        <a href="single.html"><img src="images/sai2.jpg" alt="" /></a>
                        <div class="side-bar-article-title">
                            <a href="single.html">There are many variations of passages of Lorem</a>
                        </div>
                    </div>
                    <div class="side-bar-article">
                        <a href="single.html"><img src="images/sai3.jpg" alt="" /></a>
                        <div class="side-bar-article-title">
                            <a href="single.html">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</a>
                        </div>
                    </div>
                </div> -->
            </div>
            
            <div class="secound_half">
                @if(isset($words))
                    <div class="tags">
                        <header>
                            <h3 class="title-head">Kata Kunci</h3>
                        </header>
                        <p>
                            @php
                                $i = 1;
                            @endphp

                            @foreach($words as $word)
                                <a class="tag{{$i}}" href="{{ url('2/word/' . $word->id) }}">{{ $word->word }}</a>

                                @php
                                    $i++;
                                @endphp

                            @endforeach
                        </p>
                    </div>
                @endif

                <!-- <div class="popular-news">
                    <header>
                        <h3 class="title-popular">popular News</h3>
                    </header>
                    <div class="popular-grids">
                        <div class="popular-grid">
                            <a href="single.html"><img src="images/popular-4.jpg" alt="" /></a>
                            <a class="title" href="single.html">It is a long established fact that a reader will be distracted</a>
                            <p>On Aug 31, 2015 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>250 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>68</a></p>
                        </div>
                        <div class="popular-grid">
                            <a href="single.html"><img src="images/popular-1.jpg" alt="" /></a>
                            <a class="title" href="single.html">It is a long established fact that a reader will be distracted</a>
                            <p>On Mar 14, 2015 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>250 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>68</a></p>
                        </div>
                        <div class="popular-grid">
                            <iframe width="100%" src="https://www.youtube.com/embed/LGMn_yi_62k" frameborder="0" allowfullscreen></iframe>
                            <a class="title" href="single.html">Aishwarya Rai Bachchan's Latest SHOCKING News For Ex Salman Khan</a>
                            <p>On Mar 14, 2015 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>250 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>68</a></p>
                        </div>
                        <div class="popular-grid">
                            <a href="single.html"><img src="images/popular-3.jpg" alt="" /></a>
                            <a class="title" href="single.html">It is a long established fact that a reader will be distracted</a>
                            <p>On Mar 14, 2015 <a class="span_link" href="#"><span class="glyphicon glyphicon-comment"></span>0 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span>250 </a><a class="span_link" href="#"><span class="glyphicon glyphicon-thumbs-up"></span>68</a></p>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- content-section-ends-here -->
@endsection
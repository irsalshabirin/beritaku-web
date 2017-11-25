@extends('frontend2.master')

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
<div class="main-body">
    <div class="wrap">

        <ol class="breadcrumb">
            <li><a href="{{ url('/2') }}">Home</a></li>
            <li class="active">Single Page</li>
        </ol>

        <div class="single-page">
            <!-- Share Button -->
            <!-- <div class="col-md-2 share_grid">
                <h3>SHARE</h3>
                <ul>
                    <li>
                        <a href="#">
                            <i class="facebook"></i>
                            <div class="views">
                                <span>SHARE</span>
                                <label>180</label>  
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="twitter"></i>
                            <div class="views">
                                <span>TWEET</span>
                                <label>355</label>  
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="linkedin"></i>
                            <div class="views">
                                <span>SHARES</span>
                                <label>28</label>   
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="pinterest"></i>
                            <div class="views">
                                <span>PIN</span>
                                <label>16</label>   
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="email"></i>
                            <div class="views">
                                <span>Email</span>  
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                </ul>
            </div> -->

            <div class="col-md-8 content-left single-post">
                <div class="blog-posts">
                    @if($article->media_content_url)
                        <img src="{{ $article->media_content_url }}" class="img img-responsive" style="width: 100%;margin-bottom: 20px" onerror="ImgError(this);"/>
                    @endif

                    <h3 class="post">{{ $article->title }}</h3>

                    

                    <div class="last-article">
                        
                        <p>{!! $article->content !!}</p>
                        <p><a href="{{ $article->link }}" target="_blank">Lihar Artikel Asli</a></p>
                        <!-- <h3>Donald Trump News - Donald Trump Special Reports</h3> -->
                        <!-- <iframe src="https://www.youtube.com/embed/mbDg4OG7z4Y" frameborder="0" allowfullscreen=""></iframe> -->

                        <!-- <p class="artext">The premier was meeting with Queen Elizabeth II at Buckingham Palace as the Conservatives reached the 326-seat threshold that allows them
                            to ditch their Liberal Democrat coalition partners and govern alone in the 650-seat Parliament.
                        </p> -->
                        <!-- <p class="artext">The premier was meeting with Queen Elizabeth II at Buckingham Palace as the Conservatives reached the 326-seat threshold that allows them
                            to ditch their Liberal Democrat coalition partners and govern alone in the 650-seat Parliament.
                        </p> -->
                        <!-- features -->

                        @if(isset($keywords))
                            <ul class="categories">
                                @foreach ($keywords as $keyword)
                                    <li><a href="{{ url('2/word/' . $keyword->id) }}">{{ $keyword->word }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="clearfix"></div>
                        <!--related-posts-->
                        <!-- <div class="row related-posts">
                            <h4>Articles You May Like</h4>
                            <div class="col-xs-6 col-md-3 related-grids">
                                <a href="single.html" class="thumbnail">
                                <img src="images/f2.jpg" alt=""/>
                                </a>
                                <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                            </div>
                            <div class="col-xs-6 col-md-3 related-grids">
                                <a href="single.html" class="thumbnail">
                                <img src="images/f1.jpg" alt=""/>
                                </a>
                                <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                            </div>
                            <div class="col-xs-6 col-md-3 related-grids">
                                <a href="single.html" class="thumbnail">
                                <img src="images/f3.jpg" alt=""/>
                                </a>
                                <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                            </div>
                            <div class="col-xs-6 col-md-3 related-grids">
                                <a href="single.html" class="thumbnail">
                                <img src="images/f6.jpg" alt=""/>
                                </a>
                                <h5><a href="single.html">Lorem Ipsum is simply</a></h5>
                            </div>
                        </div> -->
                        <!--//related-posts-->

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

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

                            @if(isset($random_news))
                                <div>
                                    <input id="label-2" name="lida" type="radio"  />
                                    <label for="label-2" id="item2"><i class="ferme"> </i>Berita Random<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
                                    <div class="content" id="a2">
                                        <div class="scrollbar" id="style-2">
                                            <div class="force-overflow">
                                                <div class="popular-post-grids">
                                                    @foreach($random_news as $random)
                                                        <div class="popular-post-grid">
                                                            <div class="post-img">
                                                                <a href="{{ url('2/article/' . $random->id) }}"><img src="{{ $random->media_content_url }}" alt="" onerror="ImgError(this);" /></a>
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
                            
                            @if(isset($headline_news))
                                <div>
                                    <input id="label-3" name="lida" type="radio"/>
                                    <label for="label-3" id="item3"><i class="icon-leaf" id="i2"></i>Berita Terbaru<i class="icon-plus-sign i-right1"></i><i class="icon-minus-sign i-right2"></i></label>
                                    <div class="content" id="a3">
                                        <div class="scrollbar" id="style-2">
                                            <div class="force-overflow">
                                                <div class="popular-post-grids">
                                                    @foreach($headline_news as $headline)
                                                        <div class="popular-post-grid">
                                                            <div class="post-img">
                                                                <a href="{{ url('2/article/' . $headline->id) }}"><img src="{{ $headline->media_content_url }}" alt="" /></a>
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
                                    <a class="tag{{$i}}" href="{{ url('2/word/' . $word->id) }}">{{$word->word}}</a>

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
</div>
@endsection
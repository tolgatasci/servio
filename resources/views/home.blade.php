<x-guest-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Home Video Start-->
                <section class="home-video-banner">

                    <div class="banner-area">
                        <div class="banner-caption">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 content-home">
                                        <div class="fuar-container">
                                            <h2>{{__('Fair List')}}</h2>
                                            <div class="fuar-listesi">
                                                <div class="fuar-items">
                                                    @foreach ($fairs as $fair)


                                                        <p>{{ $fair->start_date->format('d.m.Y') }} - {{ $fair->end_date->format('d.m.Y') }} {{ $fair->name }} - {{ $fair->location }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 content-home best_service">
                                        <div class="banner-welcome">
                                            <h4><p style="display:inline-block;color:#fff">{{__('Best Service')}}</p></h4>
                                            @if(!is_null($best_service))
                                            <div class="top-search-cat">

                                                <div  style="display:block;text-align: center">
                                                    <a href="{{route('service.show',['id'=>$best_service->id])}}">
                                                        <img width="250" src="{{$best_service->image}}" onerror="this.onerror=null;this.src='/assets/img/blog2.jpg';"  alt="{{$best_service->name}}">

                                                    </a>
                                                    <a href="{{route('service.show',['id'=>1])}}" >{{$best_service->name}}</a>
                                                </div>
                                            </div>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--Home Video End-->



                <!-- Video Area Start -->
                <section class="jobguru-blog-area" style="background:#eee;">
                    <div class="container pt-5 pb-5">
                        <h2 class="text-center pb-3">{{__('How can we help you?')}}</h2>
                        <div class="row">
                            @foreach($services as $service)
                            <div class="col-md-3 mt-4">
                                <div class="card katlar" style="display:block">
                                    <a href="{{route('service.show',$service->id)}}">
                                        <img src="{{$service->image}}" onerror="this.onerror=null;this.src='/assets/img/blog2.jpg';"
                                             class="img-fluid" alt="{{$service->name}}">

                                    </a>
                                    <div class="card-body">
                                        <p class="text-center font-weight-bold"><a href="{{route('service.show',$service->id)}}">{{$service->name}}</a></p>
                                        <p class="text-center mt-3">
                                            <button onclick="location.href='{{route('service.show',$service->id)}}';"
                                                    type="button" class="btn btn-success btn-xs btn-block "
                                            >{{__('GET OFFER')}}
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>

                                @endforeach


                    </div>
                </section>
                <!-- Video Area End -->



                <section class="how-works-area section_30">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="how-works-box box-1">
                                    <img src="/assets/resimler/arrow-right-top.png" alt="works">
                                    <div class="works-box-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="works-box-text">
                                        <p>{{__('Collect Offers')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="how-works-box box-2">
                                    <img src="assets/resimler/arrow-right-bottom.png" alt="works">
                                    <div class="works-box-icon">
                                        <i class="fa fa-gavel"></i>
                                    </div>
                                    <div class="works-box-text">
                                        <p>{{__('Evaluate Offers')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="how-works-box box-3">
                                    <div class="works-box-icon">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                    <div class="works-box-text">
                                        <p>{{__('Decide on a Suitable Offer')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>











                <!-- Video Area Start -->
                <section class="jobguru-video-area section_100">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="video-container">
                                    <h2>{!! __('Don\'t waste your time<br> and energy on your needs.') !!}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Video Area End -->




















        </div>
    </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <section class="jobguru-categories-area browse-category-page section_30">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-3 mb-5">
                <div class="list-group">

                    <a href="{{route('category.show',$category->id)}}" class="list-group-item list-group-item-action active" style="background-color: #8bc34a;border-color: #4CAF50;">{{$category->name}}</a>
                    @foreach($category->services as $sub)
                        <a href="{{route('service.show',$sub->id)}}" class="list-group-item list-group-item-action"><i class="fa fa-arrow-circle-o-right"></i> {{$sub->name}}</a>

                    @endforeach
                </div>
            </div>
                @endforeach

        </div>
    </div>
</section>
</x-guest-layout>

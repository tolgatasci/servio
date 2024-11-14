<x-guest-layout>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{__('Successfull!')}}!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#28a745'
                });
            });
        </script>
    @endif
    <!-- Single Candidate Start -->
    <section class="single-candidate-page bg-green" style="padding:100px 0;background:url({{$service->image}}) no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="padding:40px;border:3px solid #090;background:#fff;max-width:600px;opacity:0.9">
                        <h4 style="color:#000"><b> {{ $service->name }} için <span class="d-inline-block">{{__('Get Price Offers')}}</span></b></h4>
                        <div class="row mt-3">
                            <div class="col-md-7"><p class="font-weight-bold">{{__('Compare Prices, Confirm Offer')}}</p></div>
                            <div class="col-md-5"><button type="button"
                                                          class="btn btn-success font-weight-bold katsec"
                                                          onclick="location.href='{{route('service.apply',['service'=>$service->id])}}';">{{__('GET OFFER')}}</button></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Single Candidate End -->
    <!-- Single Candidate Bottom Start -->
    <section class="single-candidate-bottom-area section_30">
        <div class="container">


            <!-- Üst Kategori değil ise -->




            <div class="mt-5 icerik"></div>

        </div>
        <div class="col-md-4">





            <!-- Üst Kategori ise Bitişi-->


        </div>
    </section>
    <!-- Single Candidate Bottom End -->


</x-guest-layout>

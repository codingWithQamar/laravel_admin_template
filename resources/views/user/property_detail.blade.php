<x-front-layout>
    {{--
@inject('helpers', 'App\Classes\Helpers')
--}}
    <x-slot name="pageName">{{ $pageName }}</x-slot>
    <x-slot name="inPageCss">
    </x-slot>

    <!-- carousel -->
    <div class="container">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-controls="true">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 carousel-bg" src="{{ asset('Frontend/assets/img/bg1.jpg') }}"
                        alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 carousel-bg" src="{{ asset('Frontend/assets/img/bg1.jpg') }}"
                        alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 carousel-bg" src="{{ asset('Frontend/assets/img/bg1.jpg') }}"
                        alt="Third slide">
                </div>
            </div>
        </div>
    </div>
    <!-- carousel -->
    <!-- detail -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-7 pt-3">
                <h1 class="address">
                    {{ @$property->Addr }}
                    <br>
                    <span class="specific_addr">{{@$property->political? @$property->political.", ":"" }} {{ @$property->locality? @$property->locality.", ":"" }} {{@$property->administrative_area_level_1? @$property->administrative_area_level_1 .", ":"" }} {{ @$property->country }}</span>
                </h1>
                <h4 class="d-none">

                    <br>
                    street_number: {{ @$property->street_number }}
                    <br>
                    route: {{ @$property->route }}
                    <br>
                    political: {{ @$property->political }}
                    <br>
                    locality: {{ @$property->locality }}
                    <br>
                    administrative_area_level_3: {{ @$property->administrative_area_level_3 }}
                    <br>
                    administrative_area_level_2: {{ @$property->administrative_area_level_2 }}
                    <br>
                    administrative_area_level_1: {{ @$property->administrative_area_level_1 }}
                    <br>
                    country: {{ @$property->country }}
                    <br>
                    postal_code: {{ @$property->postal_code }}
                    <p>{{ @$property->Area }}</p>
                </h4>
                <p class="mt-4">Single Family Residence**</p>
            </div>
            <div class="col-lg-5 ">
                <div class="row pt-1 no-gutters" style="display: flex;">
                    <div class="col-lg-6 pt-3 text-end border-line">
                        <p>Listed for: <span style="color: #28A3B3 ; font-size: 18px;font-weight: 500;">$
                                {{ number_format(@$property->Lp_dol) }}</span></p>
                        <p>Added {{ \Carbon\Carbon::parse(@$property->Ld)->diffForHumans() }}</p>
                    </div>

                    <div class="col-lg-6 pt-3 text-start">
                        @php
                        $difference =  @$property->Lp_dol - @$property->Orig_dol;

                        $mean = ( @$property->Lp_dol+@$property->Orig_dol)/2;
                        $perc_diff = ($difference/$mean)*100;

                        $perc_diff = number_format(abs($perc_diff),2);
                        if(@$property->Lp_dol > @$property->Orig_dol){
                            $perc_diff = $perc_diff;
                            $sign = 'text-success fa fa-caret-up';
                        }else{
                            $sign = 'text-danger fa fa-caret-down';
                        }
                    @endphp
                        <p>Estimated value:</p>
                        <p>$ {{ number_format(@$property->Orig_dol, 0) }} <span
                                class="{{$sign}}"></span>





                                {{$perc_diff}}%
                                <span style="color:#28A3B3;"
                                class="fa fa-info-circle"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- detail -->
    <!-- notify -->
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-lg-6" style="height: 100%;">
                <div style="background: #E9F6F7;padding:5px 15px;border-radius: 10px;">
                    <div class="row no-gutters">
                        <div class="col-lg-1 ">
                            <i class="fa fa-bell "
                                style="color:#28A3B3;font-size: 24px !important;padding-top: 35px;"></i>
                        </div>
                        <div class="col-lg-8 pt-3">
                            <p>Watch this listing and get notified when it's sold</p>
                        </div>
                        <div class="col-lg-3" style="padding-top: 27px;">
                            <button class="btn btn-block btn-box">Sold Watch</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="height: 100%;">
                <div style="background: #E9F6F7;padding:5px 15px;border-radius: 10px;">
                    <div class="row no-gutters">
                        <div class="col-lg-1 ">
                            <i class="fa fa-bell "
                                style="color:#28A3B3;font-size: 24px !important;padding-top: 35px;"></i>
                        </div>
                        <div class="col-lg-8 pt-3">
                            <p>Watch this listing and get notified when it's sold</p>
                        </div>
                        <div class="col-lg-3" style="padding-top: 27px;">
                            <button class="btn btn-block btn-box">Sold Watch</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- notify -->
    <!-- feature -->
    <div class="container mt-4 mb-4">
        <hr>
        <div class="row pt-3">
            <div class="col-lg-4 text-center">
                <p><i class="fa fa-bed" style="font-size: 50px;position: relative;top:8px;"></i> &nbsp
                    {{ @$property->Br }} {{ @$property->Br_plus > 0 ? '+ ' . @$property->Br_plus : '' }} Bedrooms</p>
            </div>
            <div class="col-lg-4 text-center">
                <p><i class="fa fa-bath" style="font-size: 50px;position: relative;top:8px;"></i> &nbsp
                    {{ @$property->Bath_tot }} Bathrooms</p>
            </div>
            <div class="col-lg-4 text-center">
                <p><i class="fa fa-car" style="font-size: 50px;position: relative;top:8px;"></i> &nbsp
                    {{ @$property->Gar_spaces }} Garage</p>
            </div>
        </div>
        <hr>
        <div class="row mt-2">
            <div class="col-lg-12">
                <h4>Open Houses</h4>
                <p>upcoming open houses for 7831 Colonial Drive, Perth East (Single Family Residence)</p>
                <h4>Open Houses</h4>
                <p>Sun, Dec 10 2:00 PM-4:00 PM</p>
            </div>
        </div>
        <hr>
        <div class="row mt-2">
            <div class="col-lg-12">
                <h4>Listing History</h4>
                <p>Buy/sell history for 7831 Colonial Drive, Perth East (Single Family Residence)</p>
                <table class="table table-borderless text-center">
                    <thead>
                        <tr>
                            <th scope="col">Date Start</th>
                            <th scope="col">Date End</th>
                            <th scope="col">Price</th>
                            <th scope="col">Event</th>
                            <th scope="col">Listing ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bg-white"></td>
                            <td class="bg-white"></td>
                            <td class="bg-white"></td>
                            <td class="bg-white">Terminated</td>
                            <td class="bg-white" style="color: #28A3B3 ; font-size: 18px;font-weight: 500;">40519058 <i
                                    class="fa fa-search"></i></td>
                        </tr>
                        <tr>
                            <td>2023-12-02</td>
                            <td></td>
                            <td>$879,900</td>
                            <td>For Sale</td>
                            <td>40519100</td>
                        </tr>
                        <tr>
                            <td class="bg-white"></td>
                            <td class="bg-white"></td>
                            <td class="bg-white"></td>
                            <td class="bg-white">Terminated</td>
                            <td class="bg-white" style="color: #28A3B3 ; font-size: 18px;font-weight: 500;">40519058 <i
                                    class="fa fa-search"></i></td>
                        </tr>
                    </tbody>
                </table>
                <p>Buy/sell history for 7831 Colonial Drive, Perth East (Single Family Residence)</p>
                <p><b><i class="fa fa-lock"></i> Real estate boards require you to <a
                            style="text-decoration: underline;" href="">Join</a> or <a
                            style="text-decoration: underline;" href="">Log in</a> to see the full details of
                        this property.</b></p>
                <hr>
            </div>
        </div>
    </div>
    <!-- feature -->
    <!-- tabs -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">





                <!-- Tabs navs -->
                <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a type="button" class="nav-link active" id="nav-one-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one"
                            aria-selected="true">Key Facts </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a type="button" class="nav-link" id="nav-two-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-two" type="button" role="tab" aria-controls="nav-two"
                            aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a type="button" class="nav-link" id="nav-three-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-three" type="button" role="tab" aria-controls="nav-three"
                            aria-selected="true">Rooms</a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex2-content">
                    <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                        aria-labelledby="nav-one-tab" tabindex="0">







                        <div class="row">

                            <div class="col-md-12">
                                {{-- <h1 class="tabs_heading">Key facts for </h1> --}}
                            </div>
                            <div class="col-md-6">
                                <div class="tab_details">
                                    <div class="inner_details">
                                        <strong>tax:</strong><span
                                            class="details">{{ @$property->Taxes ? @$property->Taxes : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Property Type:</strong><span
                                            class="details">{{ @$property->residence_type ? @$property->residence_type : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Building Age:</strong><span
                                            class="details">{{ @$property->Yr_built ? @$property->Yr_built : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Size:</strong><span
                                            class="details">{{ @$property->Lotsz_code ? @$property->Lotsz_code : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Lot Size:</strong><span
                                            class="details">{{ @$property->Bath_tot ? @$property->Bath_tot : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Parking:</strong><span class="details">{{ @$property->Gar_type }}
                                            {{ @$property->Gar_spaces }} Garage ,{{ @$property->Park_spcs }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Basement:</strong><span
                                            class="details">{{ @$property->Bsmt1_out ? @$property->Bsmt1_out : 'NA' }}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tab_details">
                                    <div class="inner_details">
                                        <strong>Listing #:</strong><span class="details">NA</span>
                                    </div>

                                    <div class="inner_details">
                                        <strong>Data Source:</strong><span class="details">NA</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Days on Site :</strong><span class="details">
                                            {{ \Carbon\Carbon::parse(@$property->Ld)->diffInDays() }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Status Change:</strong><span
                                            class="details">{{ \Carbon\Carbon::parse(@$property->Ld)->diffForHumans() }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Added to HouseSigma :</strong><span class="details">NA</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Updated on:</strong><span
                                            class="details">{{ @$property->Ld ? @$property->Ld : 'NA' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab"
                        tabindex="0">
                        <div class="row">

                            <div class="col-md-12">
                                {{-- <h1 class="tabs_heading">Property listed for </h1> --}}
                            </div>

                            <div class="col-md-6">
                                <div class="tab_details">
                                    <h1 class="tab_details_heading">Property</h1>
                                    <div class="inner_details">
                                        <strong>Property Type:</strong><span
                                            class="details">{{ @$property->residence_type ? @$property->residence_type : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Style:</strong><span
                                            class="details">{{ @$property->Style ? @$property->Style : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Frontage Type:</strong><span
                                            class="details">{{ @$property->Comp_pts ? @$property->Comp_pts : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Community:</strong><span
                                            class="details">{{ @$property->Community ? @$property->Community : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Municipality :</strong><span
                                            class="details">{{ @$property->Municipality ? @$property->Municipality : 'NA' }}</span>
                                    </div>

                                    <h1 class="tab_details_heading">Inside</h1>
                                    <div class="inner_details">
                                        <strong>Bathrooms:</strong><span
                                            class="details">{{ @$property->bath_tot ? @$property->bath_tot : 'NA' }}</span>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tab_details">

                                    <h1 class="tab_details_heading">Land</h1>
                                    <div class="inner_details">
                                        <strong>Sewer</strong><span
                                            class="details">{{ @$property->Sewer ? @$property->Sewer : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Frontage Length:</strong><span class="details">NA</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Depth:</strong><span
                                            class="details">{{ @$property->Depth ? @$property->Depth : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Lot Size :</strong><span
                                            class="details">{{ @$property->Lotsz_code ? @$property->Lotsz_code : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Acreage:</strong><span
                                            class="details">{{ @$property->Acres ? @$property->Acres : 'NA' }}</span>
                                    </div>
                                    <div class="inner_details">
                                        <strong>Zoning:</strong><span
                                            class="details">{{ @$property->Zoning ? @$property->Zoning : 'NA' }}</span>
                                    </div>


                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab"
                        tabindex="0">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="tabs_heading">{{@$property->rms}}  {{@$property->rm1_len? "+ ". $property->rm1_len :''}}</h1>
                            </div>
                            @if(@$property->rm1_out=='' && @$property->rm2_out=='' && @$property->rm3_out=='' && @$property->rm4_out=='' && @$property->rm5_out=='' && @$property->rm6_out=='' && @$property->rm7_out==''  && @$property->rm8_out=='')
                                <h1 class="no_room_found">No Room found.</h1>

                            @endif
                            @if (isset($property->rm1_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm1_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm1_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm1_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm1_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm1_wth}} x {{@$property->rm1_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif


                            @if (isset($property->rm2_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm2_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm2_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm2_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm2_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm2_wth}} x {{@$property->rm2_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif

                            @if (isset($property->rm3_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm3_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm3_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm3_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm3_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm3_wth}} x {{@$property->rm3_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif

                            @if (isset($property->rm4_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm4_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm4_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm4_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm4_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm4_wth}} x {{@$property->rm4_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif

                            @if (isset($property->rm5_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm5_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm5_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm5_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm5_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm5_wth}} x {{@$property->rm5_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif

                            @if (isset($property->rm6_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm6_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm6_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm6_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm6_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm6_wth}} x {{@$property->rm6_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif

                            @if (isset($property->rm7_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm7_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm7_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm7_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm7_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm7_wth}} x {{@$property->rm7_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif


                            @if (isset($property->rm8_out))
                            <div class="col-md-4">
                                <div class="room_tabs">
                                    <span class="badge text-bg-info">{{@$property->rm8_out}}</span>
                                    <h1 class="room_desc_heading">Description:</h1>
                                    <p class="room_desc">
                                        {{@$property->rm8_dc1_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm8_dc2_out}}
                                        <br>
                                        <br>
                                        {{@$property->rm8_dc3_out}}

                                    </p>

                                    <div class="room_area">
                                        <strong>Width x Height:</strong> <span>{{@$property->rm8_wth}} x {{@$property->rm8_len}}</span>
                                    </div>


                                </div>
                            </div>
                            @endif


                        </div>
                    </div>
                </div>
                <!-- Tabs content -->
            </div>
        </div>
    </div>
    <!-- tabs -->

    <x-slot name="inPageJs">

        <!-- MDB -->

    </x-slot>
<div class="d-none">

    <p><b>Address:</b> {{ @$property->street_number }} {{ @$property->route }} dd</p>

    <p><b>Property Type:</b> {{ @$property->residence_type }} dd</p>
    <p><b>Listed for:</b> {{ @$property->listed_price }} dd</p>
    <p><b> days ago</b> {{ @$property->Ld }} dd</p>
    <p><b>Estimated value:</b> {{ @$property->inventory }} dd</p>

    <hr>


    <!-- bedrooms -->
    <p><b>Bedrooms:</b> {{ @$property->Rooms_plus }} dd</p>
    <p><b>Bathrooms:</b> {{ @$property->Bath_tot }} dd</p>
    <p><b>Garage:</b> {{ @$property->Gar_spaces }} dd</p>

    <hr>

    <p><b>Open Houses</b> {{ @$property->Oh_Link1 }} dd </p>
    <p><b>Open House</b> {{ @$property->Oh_Link2 }} dd </p>

    <hr>

    <p><b>Living History</b> </p>

    <p><b>Date Start </b> {{ @$property->Xdtd }} dd </p>
    <p><b>Date End: </b>{{ @$property->Xd }} dd </p>
    <p><b>Price </b> {{ @$property->listed_price }} dd </p>
    <p><b>Event </b> NA</p>
    <p><b>Listing ID</b> NA </p>

    <hr>


    <h2>Key Facts</h2>
    <p><b>Tax:</b> {{ @$property->Taxes }} dd</p>
    <p><b>Property Type::</b> {{ @$property->residence_type }} dd</p>
    <p><b>Building Age::</b> {{ @$property->Yr_built }} dd</p>
    <p><b>Size:</b> {{ @$property->Lotsz_code }} dd</p>
    <p><b>Lot Size:</b> {{ @$property->Bath_tot }} dd</p>
    <p><b>Parking:</b>{{ @$property->Gar_type }} {{ @$property->Gar_spaces }} Garage ,{{ @$property->Park_spcs }}
        Parking dd</p>
    <p><b>Basement:</b> {{ @$property->Bsmt1_out }} dd</p>
    <p><b>Listing #:</b> NA</p>
    <p><b>Data Source:</b> NA</p>
    <p><b>Days on Site:</b> {{ \Carbon\Carbon::parse(@$property->Ld)->diffInDays() }} dd</p>
    <p><b>Status Change:</b>{{ \Carbon\Carbon::parse(@$property->Ld)->diffForHumans() }} dd</p>
    <p><b>Added to HouseSigma:</b> NA </p>
    <p><b>Updated on:</b> {{ @$property->Ld }} dd</p>



    <hr>
    <h1>Deatils</h1>
    <h2>Property</h2>
    <p><b>Property Type:</b> {{ @$property->residence_type }} dd</p>
    <p><b>Style: </b>{{ @$property->Style }} dd</p>
    <p><b>Frontage Type: </b>{{ @$property->Comp_pts }} dd</p> <!-- not conform -->
    <p><b>Community: </b>{{ @$property->Community }} dd</p>
    <p><b>Municipality: </b>{{ @$property->Municipality }} dd</p>


    <hr>
    <h2>Building</h2>
    <p><b>Size: </b></p>
    <p><b>Building Age: </b>{{ @$property->Yr_built }} dd</p>
    <p><b>Direction: </b> {{ @$property->St_dir }} dd</p>
    <p><b>Roof: </b> NA</p>
    <p><b>Construction: </b> NA</p>
    <p><b>Foundation Type: </b> NA</p>
    <p><b>Security:</b> {{ @$property->secgrd_sys }} dd</p> {{-- secgrd_sys not available in object --}}


    <hr>
    <h2>Inside</h2>
    <p><b>Feature: </b></p>
    <p><b>Appliances Included: </b></p>
    <p><b>Rooms: </b> {{ @$property->rms }} dd</p>
    <p><b>Bedrooms: </b>{{ @$property->rooms_plus }} dd</p>
    <p><b>Bedrooms Above Ground: </b></p>
    <p><b>Bedrooms Below Ground: </b></p>
    <p><b>Beds on Level Basement: </b></p>
    <p><b>Bathrooms: </b>{{ @$property->bath_tot }} dd</p>
    <p><b>Full Bathrooms: </b></p>
    <p><b>Half Bathrooms: </b></p>
    <p><b>1 Piece Bathrooms: </b> {{ @$property->wcloset_p1 }} dd</p>
    <p><b>2 Piece Bathrooms: </b> {{ @$property->wcloset_p2 }} dd</p>
    <p><b>3 Piece Bathrooms: </b> {{ @$property->wcloset_p3 }} dd</p>
    <p><b>4 Piece Bathrooms: </b> {{ @$property->wcloset_p4 }} dd</p>
    <p><b>5 Plus Piece Bathrooms: </b> {{ @$property->wcloset_p5 }} dd</p>
    <p><b>Baths on Level Basement: </b></p>
    <p><b>Kitchens: </b>{{ @$property->Num_kit }} dd</p>
    <p><b>Kitchens Above Ground: </b></p>
    <p><b>Kitchens Below Ground: </b></p>
    <p><b>Fireplace: </b> NA</p>
    <p><b>Fireplace Total: </b> {{ @$property->fpl_num }} dd</p>
    <p><b>Laundry: </b>{{ @$property->Laundry }} dd</p>
    <p><b>Laundry Features: </b> NA</p>
    <p><b>Laundries on Level Main: </b> {{ @$property->laundry_lev }} dd</p>



    <hr>
    <h2>Parking</h2>

    <p><b>Driveway Parking: </b>{{ @$property->Drive }} dd</p>
    <p><b>Garage: </b>{{ @$property->Gar_spaces }} dd</p>
    <p><b>Total Parking Space: </b>{{ @$property->Tot_park_spcs }} dd</p>
    <p><b>Parking Features: </b></p>

    <hr>
    <h2>Land</h2>
    <p><b>Sewer: </b>{{ @$property->Sewer }} dd</p>
    <p><b>Frontage Length: </b></p>
    <p><b>Depth: </b>{{ @$property->Depth }} dd</p>
    <p><b>Lot Size: </b> {{ @$property->Lotsz_code }} dd</p>
    <p><b>Acreage: </b>{{ @$property->Acres }} dd</p>
    <p><b>Zoning:</b>{{ @$property->Zoning }} dd</p>

    <hr>
    <h2>Utilities</h2>

    <p><b>Cooling: </b>{{ @$property->A_c }} dd</p>
    <p><b>Heating: </b>{{ @$property->Heating }} dd</p>
    <p><b>Water: </b>{{ @$property->Water }} dd</p>
    <p><b>Water Treatment: </b> NA</p>


    <!-- <p><b></b></p> -->


    @php

        echo '<pre>';
        print_r($property);
        echo '</pre>'; //exit;

    @endphp
</div>

</x-front-layout>

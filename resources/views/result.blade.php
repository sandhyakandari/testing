@extends('layout.layout')

@section('title')
    Kheldhaara | Result
@endsection

@section('content')
    {{-- Main banner section --}}
    <section class="page-title centred custom-page-banner-section"
        style="background-image: url({{ asset('assets/images/result_banner.jpg') }});">
        <div class="container-fluid container-lg">
            <div class="content-box">
                <div class="title">Result</div>
                <ul class="bread-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Result</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="blank-box"></section>
    {{-- End Main banner section --}}

    {{-- result-table-start --}}
    <section class="cart-section portfolio-section custom-result-section">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="academies-search-box">
                        <div class="player-search player-search-name">
                            <form action="#" method="post" id="">
                                <div class="form-input-box">
                                    <input type="search" name="searchTourName" placeholder="Search Tournament Name"
                                        id="" class="form-control">
                                    <span class="search-icon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                                <div class="form-input-box">
                                    <input type="search" name="aitaSearch" placeholder="Search winner" id=""
                                        class="form-control">
                                    <span class="search-icon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                                <div class="form-input-box">
                                    <input type="search" name="citySearch" placeholder="Search City" id=""
                                        class="form-control">
                                    <span class="search-icon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                                <div class="form-button">
                                    <button type="button" class="theme-btn">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-outer result-table">
                    <table class="cart-table">
                        <thead class="cart-header result-cart-header">
                            <tr>
                                <th>NAME</th>
                                <th>DATE</th>
                                <th>Academy</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Winner</th>
                                <th>Runner Up</th>
                                <th>City</th>
                                <th>Final Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="item">
                                <td><a href="javascript:void(0)">Talent Series</a></td>
                                <td>10 Mar to 14 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Men's</td>
                                <td>Senior's</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>Delhi</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                            <tr class="item">
                                <td><a href="javascript:void(0)">National Championship</a></td>
                                <td>06 Mar to 09 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Men's</td>
                                <td>Junior's</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>Meghalaya</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                            <tr class="item">
                                <td><a href="javascript:void(0)">Talent Series</a></td>
                                <td>10 Mar to 14 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Boy's</td>
                                <td>Under 16</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>Delhi</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                            <tr class="item">
                                <td><a href="javascript:void(0)">National Championship</a></td>
                                <td>06 Mar to 09 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Men's</td>
                                <td>Senior's</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>Meghalaya</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                            <tr class="item">
                                <td><a href="javascript:void(0)">Talent Series</a></td>
                                <td>10 Mar to 14 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Boy's</td>
                                <td>Under 16</td>
                                <td>Delhi</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                            <tr class="item">
                                <td><a href="javascript:void(0)">National Championship</a></td>
                                <td>06 Mar to 09 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Men's</td>
                                <td>Junior's</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>Meghalaya</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                            <tr class="item">
                                <td><a href="javascript:void(0)">Talent Series</a></td>
                                <td>10 Mar to 14 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Women's</td>
                                <td>Senior's</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>Delhi</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                            <tr class="item">
                                <td><a href="javascript:void(0)">National Championship</a></td>
                                <td>06 Mar to 09 Mar 2024</td>
                                <td><a href="javascript:void(0)">AVB Academy</a></td>
                                <td>Girl's</td>
                                <td>Under 16</td>
                                <td>Hady Habib</td>
                                <td>Hady Habib</td>
                                <td>Meghalaya</td>
                                <td>6-7(6) 7-6(3) 6-1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- result-table-end --}}
@endsection

@section('script')
    <script></script>
@endsection

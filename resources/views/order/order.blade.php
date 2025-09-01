@extends('home.dashboard')

@section('content')


    <div>
        <div class="shadow-sm">
            <h2 class="mb-2 text-center">Order List</h2>
            {{-- <select id="orderStatus" name="status" type='text' class="p-2 form-select col-2"
                aria-label="Default select example">
                <option value="">All</option>
                <option value="true">Sent</option>
                <option value="false">Pending...</option>
                <option value="cancel">Cancle</option>
            </select> --}}

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order ID</th>
                        <th scope="col" class="w-25">Product Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">OrderDate</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                @if (count($order) === 0)
                    <p class="p-5 text-center border-pink-100">No data found matching your search criteria.</p>
                @else
                    <tbody id="dataList">
                        @foreach ($order as $index => $data)
                            <tr>
                                <input type="hidden" value="{{ $data->user_id }}" name="user_id" />
                                <input type="hidden" value="{{ $data->book_id }}" name="book_id" />
                                <input type="hidden" class="orderId" value="{{ $data->order_id }}" name="id" />
                                <th scope="row">{{ $index + 1 }}</th>
                                <td name="order_id">{{ $data->orderId }}</td>
                                <td name="bookImage"><img src="{{ asset('storage/' . $data->bookImage) }}" alt=""
                                        class="card-img w-25" /> {{ $data->bookName }}</td>
                                <td name="address">Address</td>
                                <td>{{ $data->created_at }}</td>
                                <td name="price">{{ $data->price }}</td>
                                <td>
                                    <select name="status" type='text' class="form-select au-input au-input--full "
                                        id="statusChange">
                                        <option value="true" @if ($data->selected == 'true') selected @endif>Sent
                                        </option>
                                        <option value="false" @if ($data->selected == 'false') selected @endif>Pending...
                                        </option>
                                        <option value="cancel" @if ($data->selected == 'cancel') selected @endif>Cancel
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                @endif
            </table>
        </div>
    </div>

@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#orderStatus').change(function() {
                $status = $('#orderStatus').val();
                console.log($status);

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/status',
                    data: {
                        'status': $status,
                    },
                    dataType: 'json',
                    'success': function(response) {
                        console.log(response);
                        var assetPath = '/storage/';
                        $list = '';
                        for ($i = 0; $i < response.length; $i++) {
                            $months = ['Jan', 'Feb', 'March', 'Apr', 'May', 'June', 'July',
                                'August', 'Sep', 'Oct', 'Nov', 'Dec'
                            ];
                            $dbDate = new Date(response[$i].created_at);
                            $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
                                "-" + $dbDate.getFullYear();
                            $list += `
                <tr>
                    <input type="hidden" value="${response[$i].user_id}" name="user_id"/>
                    <input type="hidden" value="${response[$i].book_id}"  name="book_id"/>
                    <input type="hidden" class="orderId" value="${response[$i].order_id}"  name="id"/>
                    <td scope="row"> ${response[$i].id}</td>
                    <td scope="col" name="order_id">${response[$i].order_id}</td>
                    <td scope="col" name="bookImage"><img src="${assetPath}${response[$i].bookImage}" alt="" class="card-img w-25"/> ${response[$i].bookName}</td>
                    <td scope="col" name="address">....</td>
                    <td scope="col">${$finalDate}</td>
                    <td scope="col" name="price">${response[$i].price}</td>
                    <td scope="col">

                        <select href="" id="statusChange" name="status" type='text' class="form-select au-input au-input--full" >
                        <option value="true" ${response[$i].selected === 'true' ? 'selected' : ''}>Sent</option>
                        <option value="false" ${response[$i].selected === 'false' ? 'selected' : ''}>Pending...</option>
                        <option value="cancel" ${response[$i].selected === 'cancel' ? 'selected' : ''}>Cancel</option>
                      </select>
                    </td>
                  </tr>
                `;
                        }
                        $('#dataList').html($list);
                    }
                })
            });
            //change staus
            $(document).on('change', '#statusChange', function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                console.log($orderId);
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                }
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
            })
        })
    </script>
@endsection

<table class="table table-striped table-hover table-bordered" id="cities-table">
    <thead>
    <tr role="row">
        <th>
            Image
        </th>
        <th>
            City
        </th>
        <th>
            Credits Left
        </th>
        <th>
            Credits Total
        </th>
        <th>
            Commission Rate
        </th>
        <th>
            Options
        </th>
    </tr>
    </thead>
    <tbody>
    @if(isset($cities))
        @foreach($cities as $city)
            <tr role="row">
                <td>
                    <img src="{{getImageUrl(basename($city['image']),\App\Models\Admin\BoostCodeProvider::IMAGE_PATH)}}"
                         width="120">
                </td>
                <td>{{$city['name']}}</td>
                <td>{{$city['credits_left']}}</td>
                <td>{{$city['credits_total']}}</td>
                <td>{{$city['commission_rate']}}%</td>
                <td>
                    <a href="{{route('boost_code_providers.edit',$city['id'])}}"
                       class="btn btn-info btn-xs edit">
                        <i class="fa fa-edit"></i> Edit</a>
                    {!!displayDeleteForm(route('boost_code_providers.destroy',$city['id']))!!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>

</table>